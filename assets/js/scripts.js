const mainUrl = "http://localhost/oop";

function remove(type, id) {
  if (confirm("Вы действительно хотите удлаить эту запись?")) {
    window.location.href = `${mainUrl}/${type}/delete/${id}`;
  }
}
