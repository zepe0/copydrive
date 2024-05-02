let album = [];
document.addEventListener("DOMContentLoaded", function () {
  const dropArea = document.getElementById("drop-area");

  // comportament per defecte
  ["dragenter", "dragover", "dragleave", "drop"].forEach((eventName) => {
    dropArea.addEventListener(eventName, preventDefaults, false);
    document.body.addEventListener(eventName, preventDefaults, false);
  });

  function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
  }

  // Es resalta l'area per deixar els arxius
  ["dragenter", "dragover"].forEach((eventName) => {
    dropArea.addEventListener(eventName, highlight, false);
  });

  ["dragleave", "drop"].forEach((eventName) => {
    dropArea.addEventListener(eventName, unhighlight, false);
  });

  function highlight(e) {
    dropArea.style.background = "#e1e1e1";
  }

  function unhighlight(e) {
    dropArea.style.background = "#fff";
  }

  // Tractar els arxius quan es deixen a l'area
  dropArea.addEventListener("drop", handleDrop, false);

  function handleDrop(e) {
    const dt = e.dataTransfer;
    const files = dt.files;

    handleFiles(files);
  }

  function handleFiles(files) {
    // upload => fetch API ??

    album.push(files[0]);
    console.log(album);
    if (album.length > 0) {
      const list = document.getElementById("listAlbum");
      const Lista = document.createElement("ul");
      const listItem = document.createElement("li");

      list.appendChild(Lista);
      Lista.attributes.id = "albumlist";
      Lista.appendChild(listItem);

      listItem.innerHTML = `<img src="${URL.createObjectURL(
        files[0]
      )}" alt="image" />`;
    } else {
      const Lista = document.getElementById("albumlist");
      const listItem = document.createElement("li");

      list.appendChild(Lista);
      Lista.appendChild(listItem);

      listItem.innerHTML = `<img src="${URL.createObjectURL(
        files[0]
      )}" alt="image" />`;
    }
  }
});
