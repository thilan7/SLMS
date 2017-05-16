<?php
/**
 * Created by PhpStorm.
 * User: Thilan K Bandara
 * Date: 3/30/2017
 * Time: 9:07 AM
 */

namespace App\Http\Controllers;


use App\Book;
use Carbon\Carbon;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;


class BookController extends Controller
{

    public function getDeletebook($book_id)
    {

        $book = Book::where('id', $book_id)->first();
        $book->delete();
        return redirect()->route('dashboard')->with(['message' => 'Book Successfully Deleted!']);
    }

    public function getEditbook($book_id)
    {
        $book = Book::where('id', $book_id)->first();
        return view('editBook', ['book' => $book]);
    }

    public function postEditbook(Request $request)
    {
        $id = $request['ID'];
        $author = $request['author'];
        $title = $request['title'];
        $isbn = $request['isbn'];
        $description = $request['description'];
        $reference = $request['reference'];

        $book = Book::where('id', $id)->first();
        if ($author != null) {
            $book->author = $author;
        }
        if ($title != null) {
            $book->title = $title;
        }
        if ($isbn != null) {
            $book->isbn_number = $isbn;
        }
        if ($description != null) {
            $book->description = $description;
        }
        if ($reference != null) {
            $book->reference = $reference;
        }
        $book->update();

        return redirect()->route('dashboard')->with(['message' => 'Book Successfully Edited!']);

    }

    public function unreserveBook($book_id)
    {
        $book = Book::where('id', $book_id)->first();
        $book->availability = true;
        $book->update();
        $tt = Book::where('id', $book_id)->first();
        $ID = $tt->book_id;
        $t = Transaction::where('book_id', $ID)->first();
        $t->delete();
        return redirect()->route('dashboard')->with(['message' => 'Book Successfully Unreserved!']);
    }

    public function reserveBook($book_id)
    {
        $t = Book::where('id', $book_id)->first();
        $ID = $t->book_id;
        $message = "you are already in two transactions. you cant reserve anymore books.";
        $tstudent = \App\Transaction::where('student_id', Auth::user()->admission_number)->get();


        if (sizeof($tstudent)<=1) {
            $transaction = new Transaction();
            $mytime = Carbon::now()->toDateTimeString();
            $transaction->reserved_date = $mytime;
            $transaction->student_id = Auth::user()->admission_number;
            $transaction->book_id = $ID;
            $transaction->save();
            $book = Book::where('id', $book_id)->first();
            $book->availability = 0;
            $book->update();
            $message = 'Book Successfully reserved!';
        }
        return redirect()->route('dashboard')->with(['message' => $message]);

    }

    public function addBook(Request $request)
    {

        $bookID = $request['bookID'];
        $title = $request['title'];
        $author = $request['author'];
        $isbn = $request['isbn'];
        $description = $request['description'];
        $reference = $request['reference'];

        $this->validate($request, [
//            'bookID' => 'required',
            'title' => 'required',
            'author' => 'required',
            'reference' => 'required',
            'bookID' => 'required|unique:books,book_id',

        ]);
        $book = new Book();
        $book->book_id = $bookID;
        $book->title = $title;
        $book->author = $author;
        $book->isbn_number = $isbn;
        $book->description = $description;
        $book->reference = $reference;
        $book->availability = true;
        $book->save();
        return Redirect::route('add')->with(['message' => 'Book Successfully Added!']);

    }

    public function searchbook(Request $request)
    {
        $this->validate($request, [
            'keyword' => 'required|max:1000'
        ]);
        $action = $request['searchBy'];
        $var = null;
        if ($action == 0) {
            $var = $this->searchbookbyTitle($request);
        } elseif ($action == 1) {
            $var = $this->searchbookbyAuthor($request);
        } elseif ($action == 2) {
            $var = $this->searchbookbyIsbn_number($request);
        } elseif ($action == 3) {
            $var = $this->searchbookbyDescription($request);
        } elseif ($action == 4) {
            $var = $this->searchbookbyBook_id($request);
        }
//        var_dump($var);
//        $posts=Post::orderBy('created_at','desc')->get();
        return view('searchBook', ['var' => $var]);
    }

    public function searchbookbyTitle(Request $request)
    {
        $keyword = $request['keyword'];
        $books = Book::where('title', 'like', '%' . $keyword . '%')->get();
//        var_dump($books);
        return $books;

    }

    public function searchbookbyAuthor(Request $request)
    {
        $keyword = $request['keyword'];
        $books = Book::where('author', 'like', '%' . $keyword . '%')->get();
//        var_dump($books);
        return $books;

    }

    public function searchbookbyBook_id(Request $request)
    {
        $keyword = $request['keyword'];
        $books = Book::where('book_id', 'like', '%' . $keyword . '%')->get();
//        var_dump($books);
        return $books;

    }

    public function searchbookbyIsbn_number(Request $request)
    {
        $keyword = $request['keyword'];
        $books = Book::where('isbn_number', 'like', '%' . $keyword . '%')->get();
//        var_dump($books);
        return $books;

    }

    public function searchbookbyDescription(Request $request)
    {
        $keyword = $request['keyword'];
        $books = Book::where('description', 'like', '%' . $keyword . '%')->get();
//        var_dump($books);
        return $books;

    }
}