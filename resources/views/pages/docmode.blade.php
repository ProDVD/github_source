@extends('layout_doctor')

@section('content')
    <div class="contentPanel">
        <div class="sessionPanel">
            <div class="scrollbar">
                <div class="sessionBox">
                    <? if($sessionList != ''):?>
                    <? foreach($sessionList as $k):?>
                    <a class="sessionLink" href="#" onClick="onLoad('<?=$k->sessionId;?>')">
                        <div class="oneSessionDoc" onClick="onLoad('<?=$k->sessionId;?>')">
                            <div class="spanIcon d-flex flex-column">
                                <span class="fa fa-envelope"></span>
                                <span class="fa fa-user"></span>
                                <span class="fa fa-calendar"> </span>
                            </div>
                            <div class="spanName d-flex flex-column">
                                <span> <?=$k->patient_email;?></span>
                                <span> <?=$k->patient_name;?></span>
                                <span> <?=$k->sessDate?> </span>
                            </div>
                        </div>
                    </a>
                    <?endforeach?>
                    <?endif?>
                </div>
            </div>
        </div>
        <div class="scrolBoxFile">
            <div class="tab-content" id="eugeneajax">
                <!-- ajax -->
            </div>
        </div>
    </div>
@endsection