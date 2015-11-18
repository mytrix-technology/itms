<?php
use MrJuliuss\Syntara\Controllers\BaseController;

class PanelController extends \BaseController {

	/**
     * Mengambil Index Page Design
     */
    public function getPanelSetting()
    {
        $this->layout = View::make(Config::get('adminlte::views.panel_setting'));
        $this->layout->title = 'Setting Panel';
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.panel_setting');
    }

    public function getPanelMaster()
    {
        $this->layout = View::make(Config::get('adminlte::views.panel_master'));
        $this->layout->title = 'Master Panel';
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.panel_master');
    }

    public function getPanelProject()
    {
        $this->layout = View::make(Config::get('adminlte::views.panel_project'));
        $this->layout->title = 'Project Panel';
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.panel_project');
    }

    public function getPanelDesign()
    {
        $this->layout = View::make(Config::get('adminlte::views.panel_design'));
        $this->layout->title = 'Design Panel';
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.panel_design');
    }

    public function getPanelTasklist()
    {
        $this->layout = View::make(Config::get('adminlte::views.panel_tasklist'));
        $this->layout->title = 'Tasklist Panel';
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.panel_tasklist');
    }

    public function getPanelDatabase()
    {
        $this->layout = View::make(Config::get('adminlte::views.panel_database'));
        $this->layout->title = 'Database Panel';
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.panel_database');
    }

    public function getPanelReport()
    {
        $this->layout = View::make(Config::get('adminlte::views.panel_report'));
        $this->layout->title = 'Report Panel';
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.panel_report');
    }
}