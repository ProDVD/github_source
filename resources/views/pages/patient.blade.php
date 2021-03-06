@extends('layout_patient')

@section('content')
    <div class="contentPanel">
        <div class="sessionPanel">
            <div class="scrollbar">
                <div class="sessionBox">
                <? if($sessionList != ''):?>
                <? foreach($sessionList as $k):?>
                    <a class="sessionLink" href="#" onclick="onLoad('{{ $k['session_id'] }}')">
                        <div class="oneSession">
                            <span>
                                <?php $date = explode(' ', $k['creation_time']) ?>
                                {{ $date[0] }}
                            </span>
                        </div>
                    </a>
                    <?endforeach?>
                    <?endif?>
                </div>
            </div>
        </div>
        <div class="scrolBoxFile">
            <div class="tab-content" id="eugeneajax">
            </div>
        </div>
    </div>
@endsection

