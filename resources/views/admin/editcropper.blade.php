                <div class="box">
                            <img   src="{{asset($image->path ?? '')}}" alt="">
                            <br>
                            <br>
                            <button onclick="toggle_visibility('picture');" class="btn  btn-sm"><h2>Редагувати фото</h2></button>
                            <br>
                        </div>
                <div class="box-2" id="picture" style="display: none">
                            <input name="file" type="file" class="btn  btn-sm" id="file-input"  title="Завантажити фото" >
                            <div class="result" ></div>
                        <div class="box-2 img-result hide">
                            <img   class="cropped" src="storage/app/public/uploads/{{Session::get('path')}}" alt="">
                        </div>
                        <div class="box">
                            <div class="options hide">
                                <input type="hidden" class="img-w" value="300" min="100" max="1200" />
                            </div>
                            <button class="btn save hide  btn-sm">Зберегти</button>
                            <a id="crop" href="" class="btn download hide" ></a>    
                            <p id="log"></p>
                        </div>
                </div>