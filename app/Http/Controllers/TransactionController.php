<?php
/**
 * Created by PhpStorm.
 * User: Thilan K Bandara
 * Date: 3/30/2017
 * Time: 9:08 AM
 */

namespace App\Http\Controllers;


use App\Book;
use App\FinalTransactions;
use App\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;


class TransactionController extends Controller
{

    public function returnBook(Request $request)
    {
        $this->validate($request, [
            'studentID' => 'required',
            'bookID' => 'required'
        ]);
        $tbook = \App\Transaction::where('book_id', $request['bookID'])->get();
        $tstudent = \App\Transaction::where('student_id', $request['studentID'])->get();
        $tbookObject = \App\Transaction::where('book_id', $request['bookID'])->first();

        $bookexistance = Book::where('book_id', $request['bookID'])->get();
        $studentexistance = User::where('admission_number', $request['studentID'])->get();


        if (sizeof($bookexistance) == 0 and sizeof($studentexistance) == 0) {
            $message = 'the student and the book doesent exist in the database!!!!!!';
            return redirect()->back()->with(['message' => $message]);

        } elseif (sizeof($bookexistance) == 0) {
            $message = 'the book doesent exist in the database!!!';
            return redirect()->back()->with(['message' => $message]);

        } elseif (sizeof($studentexistance) == 0) {
            $message = 'the student doesent exist in the database!!!';
            return redirect()->back()->with(['message' => $message]);

        } elseif (sizeof($tbook) == 0) {
            $message = 'the book is not in a transaction!!!!!!';
            return redirect()->back()->with(['message' => $message]);

        } elseif (sizeof($tstudent) == 0) {
            $message = 'the student is not in a transaction!!!!!!';
            return redirect()->back()->with(['message' => $message]);

        } elseif ($tbookObject->student_id == $request['studentID']) {
//            $book = Book::where('book_id', $request['bookID'])->first();
//            $book->availability = 1;
//            $book->update();

            $dueDate = $tbookObject->due_date;
            $now = Carbon::now();
            $duedate = new Carbon($dueDate);
            $fine = 0;
            if ($now > $duedate) {
                $fine = 2 * ($now->diffInDays($duedate));

            }
            $tbookObject->fine = $fine;
            $tbookObject->returned_date=$now;
            $tbookObject->update();
//            dd($fine);
            $bookexistance = Book::where('book_id', $request['bookID'])->first();
            $studentexistance = User::where('admission_number', $request['studentID'])->first();
            return view('returnBookFinal', ['transactionObject' => $tbookObject, 'fine' => $fine, 'bookDetail' => $bookexistance, 'studentDetail' => $studentexistance]);
        } else {
            $message = "bookID and students ID doesen`t match.";
            return redirect()->back()->with(['message' => $message]);

        }
    }

    public function returnBookFinal($book_id)
    {
//        dd($book_id);
        $book = Book::where('book_id', $book_id)->first();
        $book->availability = true;
        $book->update();
        $t = Transaction::where('book_id', $book_id)->first();

        $Finaltransaction = new FinalTransactions();
        $Finaltransaction->student_id = $t->student_id;

        $Finaltransaction->book_id = $t->book_id;
        $Finaltransaction->fine=$t->fine;
        $Finaltransaction->returned_date=$t->returned_date;
        $Finaltransaction->burrowed_date = $t->burrowed_date;
        $Finaltransaction->due_date = $t->due_date;
        $Finaltransaction->save();

        $t->delete();
        return redirect()->route('dashboard')->with(['message' => 'Book Successfully returned!']);
    }

    public function getTransactionHistory(Request $request)
    {
        $tbook = \App\FinalTransactions::all();
        return view('transactionHistory', ['data' => $tbook]);
    }

    public function lendBook(Request $request)
    {
        $message = 'the book successfully lended!!!';
        //validation
        $this->validate($request, [
            'studentID' => 'required',
            'bookID' => 'required'
        ]);
        $tbook = \App\Transaction::where('book_id', $request['bookID'])->get();
        $tstudent = \App\Transaction::where('student_id', $request['studentID'])->get();

        $bookexistance = Book::where('book_id', $request['bookID'])->get();
        $studentexistance = User::where('admission_number', $request['studentID'])->get();

        if (sizeof($bookexistance) == 0) {
            $message = 'the book doesent exist in the database!!!';
        }
        if (sizeof($studentexistance) == 0) {
            $message = 'the student doesent exist in the database!!!';
        }
        if (sizeof($bookexistance) == 0 and sizeof($studentexistance) == 0) {
            $message = 'the student and the book doesent exist in the database!!!!!!';
        } elseif (sizeof($tstudent) == 2) {
            $message = 'user has already in 2 transactions!!!';
        } elseif (sizeof($tbook) == 1) {
            $message = 'book is already in a transactions!!!';
        } else {
            $bookavailability = Book::where('book_id', $request['bookID'])->first();

            if ($bookavailability->reference == 1) {//reference book
                $message = 'book is a reference book!!!';
            } else {
                $transaction = new Transaction();
                $transaction->student_id = $request['studentID'];
                $transaction->book_id = $request['bookID'];
                $time = Carbon::now();
                $mytime = $time->toDateTimeString();
                $transaction->burrowed_date = $mytime;
                $transaction->due_date = $time->addWeeks(2)->toDateTimeString();
                $transaction->save();

                $student = User::where('admission_number', $request['studentID'])->first();

                $book = Book::where('book_id', $request['bookID'])->first();
                $book->availability = 0;
                $book->update();

                $data=['bookID'=>$request['bookID'],'studentID'=>$request['studentID'],'burrowed_date'=>$mytime,'due_date'=>$time->addWeeks(2)->toDateTimeString(),'email'=>$student->email];
                Mail::send('bookBurrowEmail',$data,function ($message) use ($data){
                    $message->to($data['email'])->subject("Burrowing a book!!!");
                });

            }
        }
        return redirect()->back()->with(['message' => $message]);
    }
}