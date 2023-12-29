<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    #colorPicker {
      cursor: crosshair;
      position: relative;
    }
  </style>
  <title>Color Picker</title>
</head>
<body>

  <h1>Color Picker</h1>
  <p>Klik pada gambar atau unggah gambar untuk memilih warna.</p>
  <input type="file" id="imageInput" accept="image/*">
  <canvas id="colorPicker" width="300" height="200"></canvas>
  <p id="selectedColor"></p>
  <div id="captureList"></div>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var canvas = document.getElementById("colorPicker");
      var ctx = canvas.getContext("2d");
      var selectedColorElement = document.getElementById("selectedColor");
      var imageInput = document.getElementById("imageInput");
      var captureList = document.getElementById("captureList");
      var captureNumber = 1;

      imageInput.addEventListener("change", function(event) {
        var file = event.target.files[0];
        if (file) {
          var reader = new FileReader();
          reader.onload = function(e) {
            var image = new Image();
            image.src = e.target.result;
            image.onload = function() {
              ctx.drawImage(image, 0, 0, canvas.width, canvas.height);
            };
          };
          reader.readAsDataURL(file);
        }
      });

      canvas.addEventListener("click", function(event) {
        var x = event.clientX - canvas.getBoundingClientRect().left;
        var y = event.clientY - canvas.getBoundingClientRect().top;

        // Mendapatkan nilai warna pada titik yang diklik
        var pixel = ctx.getImageData(x, y, 1, 1).data;
        var rgb = "RGB(" + pixel[0] + ", " + pixel[1] + ", " + pixel[2] + ")";
        selectedColorElement.textContent = "Warna terpilih: " + rgb;

        // Menambahkan informasi capture ke dalam daftar
        var captureInfo = document.createElement("p");
        captureInfo.textContent = captureNumber + ". " + rgb + " Capture " + captureNumber;
        captureList.appendChild(captureInfo);

        // Menambahkan nomor capture
        captureNumber++;
      });
    });
  </script>

</body>
</html>
