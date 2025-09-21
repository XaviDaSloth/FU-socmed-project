document.addEventListener('DOMContentLoaded', function() {
  const imageInput = document.getElementById('fileToUpload');
  const saveButton = document.getElementById('saveButton');
  const errorMessage = document.getElementById('errorMessage');
  const imageForm = document.getElementById('imageForm');
  const imagePreview = document.getElementById('imagePreview');

  imageInput.addEventListener('change', function() {
    const file = imageInput.files[0];
    
    if (file) {
      // Validate file type and size
      const fileType = file.type;
      const fileSize = file.size;

      if (fileType !== 'image/jpeg' && fileType !== 'image/png') {
        errorMessage.textContent = 'Please upload a JPEG or PNG image.';
        errorMessage.style.display = 'block';
        saveButton.style.display = 'none';
      } else if (fileSize > 2 * 1024 * 1024) {  // 2MB limit
        errorMessage.textContent = 'File size should not exceed 2MB.';
        errorMessage.style.display = 'block';
        saveButton.style.display = 'none';
      } else {
        errorMessage.style.display = 'none';
        saveButton.style.display = 'inline-block';
      }
      const reader = new FileReader();
      reader.onload = function(e) {
        imagePreview.src = e.target.result;
        imagePreview.style.display = 'block'; // Show preview
      }
      reader.readAsDataURL(file);
    }
  });

  // The form will be submitted naturally when the "Save" button is clicked

});
