var lancer_cam = document.getElementById("cam_on");
var fermer_cam = document.getElementById("cam_off");
lancer_cam.onclick = function lancerCam() { /* lancer la cam au clic */
  console.log("clic sur lancer cam");
  var new_video =  document.createElement("video"); /* creation de l'element video */
  new_video.setAttribute("id", "video");

  var balise_ref = document.getElementById("cam_on"); /* balise avant laquelle on insère la balise video */
  var parentDiv = balise_ref.parentNode;
  parentDiv.insertBefore(new_video, balise_ref);

  // console.log(document.querySelector('#video'));
(function capture() { /* Script de capture depuis la webcam */

  var streaming = false,
      video        = document.querySelector('#video'),
      cover        = document.querySelector('#cover'),
      canvas       = document.querySelector('#canvas'),
      photo        = document.querySelector('#photo'),
      startbutton  = document.querySelector('#startbutton'),
      width = 600,
      height = 0;
  console.log(video);
  navigator.getMedia = ( navigator.getUserMedia ||
                         navigator.webkitGetUserMedia ||
                         navigator.mozGetUserMedia ||
                         navigator.msGetUserMedia);

  navigator.getMedia(
    {
      video: true,
      audio: false
    },
    function(stream) {
      if (navigator.mozGetUserMedia) {
        video.mozSrcObject = stream;
      } else {
        var vendorURL = window.URL || window.webkitURL;
        video.src = vendorURL.createObjectURL(stream);
      }
      video.play();
    },
    function(err) {
      console.log("An error occured! " + err);
    }
  );

  video.addEventListener('canplay', function(ev){
    if (!streaming) {
      height = video.videoHeight / (video.videoWidth/width);
      video.setAttribute('width', width);
      video.setAttribute('height', height);
      canvas.setAttribute('width', width);
      canvas.setAttribute('height', height);
      streaming = true;
    }
  }, false);

  function takepicture() {
    canvas.width = width;
    canvas.height = height;
    canvas.getContext('2d').drawImage(video, 0, 0, width, height);
    var data = canvas.toDataURL('image/png');
    photo.setAttribute('src', data);
  }

  startbutton.addEventListener('click', function(ev){
      takepicture();
    ev.preventDefault();
  }, false);

})();
}
fermer_cam.onclick = function fermerCam() {
  video.remove();
  console.log(video);
}
