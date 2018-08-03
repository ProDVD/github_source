@extends('layout_doctor')

@section('content')
    <div class="contentPanel">
        <div class="sessionPanel">
            <div class="scrollbar">
                <div class="sessionBox">
                    @foreach($sessionList as $link)
                        <a class="sessionLink" href="#" @click="loadFiles({{ $link['session_id']}})">
                            <div class="oneSessionDoc">
                                <div class="spanIcon d-flex flex-column">
                                    <span class="fa fa-envelope"></span>
                                    <span class="fa fa-user"></span>
                                    <span class="fa fa-calendar"> </span>
                                </div>
                                <div class="spanName d-flex flex-column">
                                    <span>{{ $link['email']}}</span>
                                    <span>{{ $link['name']}}</span>
                                    <span>{{ explode(' ', $link['creation_time'])[0]}}</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="scrolBoxFile">
            <div class="tab-content">

                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="home-tab">

                    <div class="inTopPanel">
                        <div class="fileBox" v-for="file in files">
                            <div class="imageBLock">
                                <div class="modalWin">
                                    <a href="#modal" data-toggle="modal">
                                        <img :src="file.thumbnailSource" alt="image" width="200px" height="150px">
                                        <img class="icon" :src="'image/icon/'+file.type+'.png'" alt="">
                                    </a>
                                </div>
                                <div v-if="file.type == 'video'" class="duration" :id="'duration-' + file.type"> @{{ file.type }}</div>
                            </div>
                            <div class="fileNameBlock">@{{ file.name }}</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection