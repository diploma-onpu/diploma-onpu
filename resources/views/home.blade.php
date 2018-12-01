<?php
use App\Traits\TranslateTrait as Trans;
$link = Trans::trans('link');
?>
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="modal-header">
                    <h5 class="modal-title text-center"><?= Trans::trans('dashboard')?></h5>
                </div>
                <div class="modal-body div-table">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center"><?= Trans::trans('parameter')?></th>
                            <th class="text-center"><?= Trans::trans('value')?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><?= Trans::trans('operation_system')?></td>
                            <th id="os"></th>
                        </tr>
                        <tr>
                            <td><?= Trans::trans('browser')?></td>
                            <th id="browser"></th>
                        </tr>
                        <tr>
                            <td><?= Trans::trans('browser_width')?></td>
                            <th id="browser-width"></th>
                        </tr>
                        <tr>
                            <td><?= Trans::trans('browser_height')?></td>
                            <th id="browser-height"></th>
                        </tr>
                        <tr>
                            <td><?= Trans::trans('screen_width')?></td>
                            <th id="screen-width"></th>
                        </tr>
                        <tr>
                            <td><?= Trans::trans('screen_height')?></td>
                            <th id="screen-height"></th>
                        </tr>
                        <tr>
                            <td><?= Trans::trans('speed')?></td>
                            <th id="speed"></th>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer div-footer">
                    <button type="button" class="btn btn-primary" id="content-ajax"><?= Trans::trans('get_params')?></button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="exampleModalLabel"><?= Trans::trans('downloads')?></h5>
                </div>
                <div class="modal-body">
                    <div class="data-link"><span><?= $link?>:&nbsp;</span><span id="div-data-fast">
                            <a href="javascript: void(0);"><?= Trans::trans('download_maximum_size_of_data')?></a>
                        </span></div>

                    <div class="data-link"><span><?= $link?>:&nbsp;</span><span id="div-data-middle">
                            <a href="javascript: void(0);"><?= Trans::trans('download_medium_size_of_data')?></a>
                        </span></div>

                    <div class="data-link"><span><?= $link?>:&nbsp;</span><span id="div-data-min">
                           <a href="javascript: void(0);"><?= Trans::trans('download_minimum_size_of_data')?></a>
                        </span></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="get-content"><?= Trans::trans('get_content_max_size')?></button>
                    <button type="button" class="btn btn-success" id="get-recommended-content"><?= Trans::trans('get_recommended_content')?>
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= Trans::trans('close')?></button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
