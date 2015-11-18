<?php
use MrJuliuss\Syntara\Controllers\BaseController;

class MailboxController extends \BaseController {

	/**
	 * Mengambil Index Page Mailbox
	 */
	public function getIndex()
    {
        // get alls Vendors
        $mailboxes = Mailbox::orderBy('id', 'DESC')->get(); // akses modul dirutkan berdasarkan ID
        
        // ajax request : reload only content container
        if(Request::ajax())
        {
            $html = View::make(Config::get('adminlte::views.mailboxes-list'), array('mailboxes' => $mailboxes))->render();
            //$this->layout = View::make(Config::get('adminlte::views.mailboxes-index'), array('mailboxes' => $mailboxes))->render();

            return Response::json(array('html' => $html));
        }
        
        // menampilkan data di index page
        $this->layout = View::make(Config::get('adminlte::views.mailboxes-index'), array('mailboxes' => $mailboxes));
        $this->layout->title = "Mailbox";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.mailboxes');
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('mailboxes.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('mailboxes.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('mailboxes.edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
