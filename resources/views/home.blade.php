@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="modal-header">
                    <h5 class="modal-title text-center">Dashboard</h5>
                </div>
                <div class="modal-body div-table">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center">parameter</th>
                            <th class="text-center">value</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Operation system</td>
                            <th id="os"></th>
                        </tr>
                        <tr>
                            <td>Browser</td>
                            <th id="browser"></th>
                        </tr>
                        <tr>
                            <td>Browser width</td>
                            <th id="browser-width"></th>
                        </tr>
                        <tr>
                            <td>Browser height</td>
                            <th id="browser-height"></th>
                        </tr>
                        <tr>
                            <td>Screen width</td>
                            <th id="screen-width"></th>
                        </tr>
                        <tr>
                            <td>Screen height</td>
                            <th id="screen-height"></th>
                        </tr>
                        <tr>
                            <td>Speed</td>
                            <th id="speed"></th>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer div-footer">
                    <button type="button" class="btn btn-primary" id="content-ajax">Get params</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Recommended content according to your parameters</h5>
                </div>
                <div class="modal-body">
                    <div class="data-link"><span>link:&nbsp;</span><span id="div-data-fast">
                            <a href="javascript: void(0);">Download maximum size of data</a>
                        </span></div>

                    <div class="data-link"><span>link:&nbsp;</span><span id="div-data-middle">
                            <a href="javascript: void(0);">Download medium size of data</a>
                        </span></div>

                    <div class="data-link"><span>link:&nbsp;</span><span id="div-data-min">
                           <a href="javascript: void(0);">Download minimum size of data</a>
                        </span></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="get-content">Get content (max. size)</button>
                    <button type="button" class="btn btn-success" id="get-recommended-content">Get recommended content
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
