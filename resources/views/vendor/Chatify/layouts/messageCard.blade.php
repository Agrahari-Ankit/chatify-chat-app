<?php
$seenIcon = (!!$seen ? 'check-double' : 'check');
$timeAndSeen = "<span data-time='$created_at' class='message-time'>
        ".($isSender ? "<span class='fas fa-$seenIcon' seen'></span>" : '' )." <span class='time'>$timeAgo</span>
    </span>";
?>
<div class="message-card-wrapper @if($isSender) mc-sender @endif">
    @if($loadUserInfo)
    <div class="message-user">
        <img src="{{$user->avatar}}"/>
        <p>{{$user->name}}</p>
    </div>
    @endif
    <div class="message-card checkmess @if($isSender) mc-sender @endif" data-id="{{ $id }}">
        {{-- Delete Message Button --}}
        @if ($isSender)
            <div class="actions">
                <i class="fas fa-trash delete-btn" data-id="{{ $id }}"></i>
            </div>
        @endif
        {{-- Card --}}
        <div class="message-card-content">
            @if (@$attachment->type != 'image' || $message)
                <div class="message">
                    {!! ($message == null && $attachment != null && @$attachment->type != 'file') ? $attachment->title : nl2br($message) !!}
                    {!! $timeAndSeen !!}
                    {{-- If attachment is a file --}}
                    @if(@$attachment->type == 'file')
                        <a href="{{ route(config('chatify.attachments.download_route_name'), ['fileName'=>$attachment->file]) }}" class="file-download">
                            <span class="fas fa-file"></span> {{$attachment->title}}</a>
                    @endif
                </div>
            @endif
            @if(@$attachment->type == 'image')
                <div class="image-wrapper" style="text-align: {{$isSender ? 'end' : 'start'}}">
                    <div class="image-file chat-image" style="background-image: url('{{ Chatify::getAttachmentUrl($attachment->file) }}')">
                        <div>{{ $attachment->title }}</div>
                    </div>
                    <div style="margin-bottom:5px">
                        {!! $timeAndSeen !!}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
        function highlightMessageCard(messageId) {
            const cardWrappers = document.querySelectorAll('.checkmess');
            let found = false;

            cardWrappers.forEach(card => {
                if (card.getAttribute('data-id') === messageId) {
                    card.classList.add('highlight');
                    card.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                    found = true;
                } else {
                    card.classList.remove('highlight');
                }
            });

            if (!found) {
                console.error('Message card not found.');
            }
        }

        function getQueryParam(paramName) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(paramName);
        }

        const messageId = getQueryParam('messageid');
        if (messageId) {
            highlightMessageCard(messageId);
        } 
            
 
 </script>