<? if($fileList!=''):?>
<div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="home-tab">
    {{--All files tabs--}}
    <div class="inTopPanel" >
        <? foreach($fileList as $k):?>
        <div class="fileBox">
            <div class="imageBLock" >
                <div class="modalWin">
                    <a href="#modal<?=$k->type?>"  data-toggle="modal"  onClick="loadProp('<?=$k->type?>', '<?=$k->directLink?>', '<?=$k->downloadLink?>')">
                        <img src="<?=$k->thumbnailSource?>" alt="image" width="200px" height="150px">
                        <img  class="icon" src="image/icon/<?=$k->type?>.png" alt=""></a>
                </div>
                <? if ($k->type == 'video'):?>
                <div class="duration" id="duration<?=$k->type?>">
                    <?=$k->duration?>
                </div> <?endif?>
            </div>
            <div class="fileNameBlock" >
                <span>  <?=$k->name?></span>
            </div>
        </div>
        <?endforeach?>

    </div>
</div>
{{--Video tabs only--}}
<div class="tab-pane fade" id="video" role="tabpanel" aria-labelledby="contact-tab">
    <div class="inTopPanel">
        <? foreach($fileList as $k):?>
        <? if($k->type =='video'):?>
        <div class="fileBox">
            <div class="imageBLock" >
                <div class="modalWin">
                    <a href="#modal<?=$k->type?>"  data-toggle="modal"  onClick="loadProp('<?=$k->type?>', '<?=$k->directLink?>', '<?=$k->downloadLink?>')">
                        <img src="<?=$k->thumbnailSource?>" alt="image" width="200px" height="150px">
                        <img  class="icon" src="image/icon/<?=$k->type?>.png" alt=""> </a>
                </div>
                <div class="duration" id="duration">
                    <?=$k->duration?>
                </div>
            </div>
            <div class="fileNameBlock">
                <span>  <?=$k->name?></span>
            </div>
        </div>
        <?endif?>
        <?endforeach?>
    </div>
</div>

{{--Photo tabs only--}}
<div class="tab-pane fade" id="photo" role="tabpanel" aria-labelledby="profile-tab">
    <div class="inTopPanel">
        <? foreach($fileList as $k):?>
        <? if($k->type =='photo'):?>
        <div class="fileBox">
            <div class="imageBLock" >
                <div class="modalWin">
                    <a href="#modal<?=$k->type?>"  data-toggle="modal"  onClick="loadProp('<?=$k->type?>', '<?=$k->directLink?>', '<?=$k->downloadLink?>')">
                        <img src="<?=$k->thumbnailSource?>" alt="image" width="200px" height="150px">
                        <img  class="icon" src="image/icon/<?=$k->type?>.png" alt=""></a>
                </div>
            </div>
            <div class="fileNameBlock" >
                <span>  <?=$k->name?></span>
            </div>
        </div>
        <?endif?>
        <?endforeach?>
    </div>
</div>
<?endif?>


