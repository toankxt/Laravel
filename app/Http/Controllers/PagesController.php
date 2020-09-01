<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
  /**
   * Controller index
   * @return page index
   */
    public function index() {
      $title = 'Hello World ^^';
      return view('pages.index', compact('title'));

      // return view('pages.index');
    }

    /**
     * Controller About
     * @return page About
     */
    public function about() {
      return view('pages.about');
    }

    /**
     * Controller Services
     * @return page Services
     */
    public function services() {
      $data = array(
        'title' => 'Services 01',
        'services' => ['Web Design', 'Programming', 'SEO']
      );

      return view('pages.services')->with($data);
    }


}
