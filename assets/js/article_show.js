'use strict';

import $ from 'jquery';
global.$ = global.jQuery = $;
import Routing from './components/routing';
import NoteSection from './components/notes.react';
import React from 'react';
import ReactDOM from 'react-dom';

$(document).ready(function() {
    $('.js-like-article').on('click', function(e) {
        e.preventDefault();

        var $link = $(e.currentTarget);
        $link.toggleClass('fa-heart-o').toggleClass('fa-heart');

        $.ajax({
            method: 'POST',
            url: $link.attr('href')
        }).done(function(data) {
            $('.js-like-article-count').html(data.hearts);
        })
    });
});
var articleid = $('.js-article-id').data('id');
var notesUrl = Routing.generate('article_show_comments', {id: articleid});

ReactDOM.render(
<NoteSection url={notesUrl} />,
document.getElementById('js-notes-wrapper')
);