<?php
use App\Traits\TranslateTrait as Trans;
$link = Trans::trans('link');
?>
@extends('layouts.app')
@section('content')

<div class="container">
    <div>
        <?= Trans::trans('average_statistic') ?>
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th><?= Trans::trans('average_speed')?></th>
            <th><?= Trans::trans('average_browser_width')?></th>
            <th><?= Trans::trans('average_browser_height')?></th>
            <th><?= Trans::trans('average_screen_width')?></th>
            <th><?= Trans::trans('average_screen_height')?></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ $averageArray['average_speed'] }}</td>
            <td>{{ $averageArray['average_browser_width'] }}</td>
            <td>{{ $averageArray['average_browser_height'] }}</td>
            <td>{{ $averageArray['average_screen_width'] }}</td>
            <td>{{ $averageArray['average_screen_height'] }}</td>
        </tr>
        </tbody>
    </table>

    <div>
        <?= Trans::trans('all_statistic') ?>
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th><?= Trans::trans('user_id')?></th>
            <th><?= Trans::trans('browser_type')?></th>
            <th><?= Trans::trans('browser_width')?></th>
            <th><?= Trans::trans('browser_height')?></th>
            <th><?= Trans::trans('screen_width')?></th>
            <th><?= Trans::trans('screen_height')?></th>
            <th><?= Trans::trans('speed')?></th>
            <th><?= Trans::trans('date')?></th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $row)
        <tr>
            <td>{{ $row->user_id }}</td>
            <td>{{ $row->browser_type }}</td>
            <td>{{ $row->browser_width }}</td>
            <td>{{ $row->browser_height }}</td>
            <td>{{ $row->screen_width }}</td>
            <td>{{ $row->screen_height }}</td>
            <td>{{ $row->speed }}</td>
            <td>{{ $row->created_at }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{ $data->links() }}
</div>
@endsection
