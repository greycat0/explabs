function changeButton(id, csrf) {
  var idObj = 'id' + id;
  var obj = document.getElementById(idObj);
  var idTaskName = 'name' + id;
  var objTaskName = document.getElementById(idTaskName);
  var okButton = document.createElement('button');
  okButton.innerHTML = "OK";
  var textLine = document.createElement('input');
  textLine.value = objTaskName.innerHTML;
  textLine.addEventListener("focusout", function (event) {
    if (event.relatedTarget != okButton) {
      textLine.remove();
      okButton.remove();
      objTaskName.style.display = 'inline';
    }
  });
  okButton.addEventListener('click', function () {
    objTaskName.innerHTML = textLine.value;
    textLine.remove();
    okButton.remove();
    objTaskName.style.display = 'inline';
    var request = new XMLHttpRequest();
    var requestBody = "name=" + objTaskName.innerHTML;
    request.open('POST', '/taskChange/' + id, true);
    request.setRequestHeader('X-CSRF-Token', csrf);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.send(requestBody);
  });
  okButton.addEventListener('focusout', function () {
    if (event.relatedTarget != textLine) {
      textLine.remove();
      okButton.remove();
      objTaskName.style.display = 'inline';
    }
  });
  objTaskName.style.display = 'none';
  obj.appendChild(textLine);
  obj.appendChild(okButton);
  textLine.focus();
}