/* global $f */
require('styles.scss');

import Settings from 'flexcss/src/main/util/Settings';
import Modal from 'flexcss/src/main/Modal';
import Widget from 'flexcss/src/main/Widget';

document.addEventListener('DOMContentLoaded', () => {

    const modal = new Modal(document.body);
    Settings.setup({
        scrollbarUpdateNodes: [document.body]
    });

    document.body.addEventListener('click', function (e) {
        var maybePlayer = e.target.getAttribute('data-play-cover');
        if (maybePlayer) {
            const video = new Widget(), el = document.getElementById(maybePlayer);
            let player;
            video.setAsync(() => {
                return new Promise((resolve) => {
                    const frame = el.querySelector('iframe');
                    player = $f(frame);
                    player.addEvent('ready', function () {
                        player.api('play');
                        resolve(el);
                    });
                });
            });

            el.addEventListener('flexcss.modal.closed', (e) => {
                player.api('pause');
            });

            modal.fromWidget(video)
        }
    });
});