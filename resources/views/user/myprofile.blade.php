@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            User {{ $user->member->getFullName() }}

            @each('partials.post', $posts, 'post')

            {{ $posts->links() }}

            <div class="modal fade" id="commentsModal" tabindex="-1" role="dialog" aria-labelledby="commentsModalLable" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                             <h4 class="modal-title">{{ trans('app.comments') }} (<span id="commentsCount"></span>) {!! manual_link('Kommentare') !!}</h4>
                        </div>
                        <div class="modal-body" id="commentsModalBody">
                            
                        </div>
                        <div class="modal-body row">
                            <form class="form" id="commentsModalForm">
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="commentsBody" placeholder="{{ trans('app.write_a_comment') }}">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-default" id="commentsPostButton">{{ trans('app.post_comment') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
