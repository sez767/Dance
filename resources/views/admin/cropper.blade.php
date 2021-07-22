
<div id="output" class="row containerImg"></div>
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Виберіть розмір зображення</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-8">
                            <img id="image" src="">
                        </div>
                        <div class="col-md-4">
                            <div class="preview"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Відміна</button>
                <button type="button" class="btn btn-primary" id="crop">Зберегти</button>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<script>
     const output = document.getElementById('output');
    var $modal = $('#modal');
    var image = document.getElementById('image');
    var cropper;
    var fileTypes = ['jpg', 'jpeg', 'png'];
    
  
  $("body").on("change", ".image", function(e){
      var files = e.target.files;
      var fileone = this.files[0];
      var fileExt = fileone.type.split('/')[1];
      if (fileTypes.indexOf(fileExt) !== -1) {
      var done = function (url) {
        image.src = url;
        $modal.modal('show');
      };
    }else{alert("Невірний формат зображення ('jpg','jpeg','png')");}
      var reader;
      var file;
      var url;
  
      if (files && files.length > 0) {
        file = files[0];
  
        if (URL) {
          done(URL.createObjectURL(file));
        } else if (FileReader) {
          reader = new FileReader();
          reader.onload = function (e) {
            done(reader.result);
  
          };
          reader.readAsDataURL(file);
        }
      }
  });
    
  $modal.on('shown.bs.modal', function () {
      cropper = new Cropper(image, {
      aspectRatio: 0,
      viewMode: 2,
      preview: '.preview'
  });
  
  }).on('hidden.bs.modal', function () {
     cropper.destroy();
     cropper = null;
  });
    
  $("#crop").click(function(){
      canvas = cropper.getCroppedCanvas({
        minWidth: 200,
        minHeight: 100,
        maxWidth: 600,
        maxHeight: 500,
        fillColor: '#fff',
        imageSmoothingEnabled: true,
        imageSmoothingQuality: 'high',
  
        });
  
  
      canvas.toBlob(function(blob) {
          url = URL.createObjectURL(blob);
          var reader = new FileReader();
          reader.readAsDataURL(blob); 
          reader.onloadend = function() {
              var base64data = reader.result;
              const img = document.createElement("IMG");
              img.src = base64data;
              img.classList.add('smallImg','img-thumbnail');
              const divdiv = document.createElement("DIV");
              divdiv.classList.add('containerDiv','wrap');
              document.getElementById("photo").value=base64data;  
                output.innerHTML = "";
                output.style.maxHeight="700px";  
                output.appendChild(divdiv);
                divdiv.appendChild(img);
                $modal.modal('hide');
             
           }
      });
  })
</script>