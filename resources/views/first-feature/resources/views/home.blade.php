@extends('layouts.app')

@section('content')
    @if (auth()->user()->role == 'admin')
        @if($request->isMethod("post"))
        {{$request->input("name")}}
        @endif
        <div class="container form-group">
            <form>
                <table class="table table-striped" id="tasks">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Description</td>
                        </tr>
                    </thead>
                    <tfoot align="center">
                        <tr id="addTR" >
                            <td style="padding:0px;" colspan="2">
                                <button id="addButton" onclick="clickAdd()" type="button" class=" btn btn-success">Add</button>
                                <button style="display:none;" id="cancel" onclick="clickCancel()" type="button" class="btn btn-danger">Cancel</button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </form>
        </div>


        <script language="JavaScript">
            var isAddRecord = false;
            var taskTR;
            var nameLineEdit;
            var descLineEdit;
            var TD1;
            var TD2;
            function clickAdd() {
                if (isAddRecord == false) {
                    isAddRecord = true;
                    taskTR = document.createElement("tr");
                    TD1 = document.createElement("td");
                    TD2 = document.createElement("td");
                    nameLineEdit = document.createElement("input");
                    descLineEdit = document.createElement("input");
                    TD1.appendChild(nameLineEdit);
                    TD2.appendChild(descLineEdit);
                    taskTR.appendChild(TD1);
                    taskTR.appendChild(TD2);
                    tasks.insertBefore(taskTR, tasks.lastChild);
                    addButton.innerHTML = "OK";
                    cancel.style.display = "inline-block";

                } else {
                    var nameField= nameLineEdit.value;
                    var descField = descLineEdit.value;
                    if (nameField == "")
                    {
                        return 1;
                    }
                    if (descField == "")
                    {
                        return 1;
                    }
                    addButton.innerHTML = "Add";
                    cancel.style.display = "none";
                    isAddRecord = false;
                    nameLineEdit.remove();
                    descLineEdit.remove();
                    TD1.appendChild(document.createTextNode(nameField));
                    TD2.appendChild(document.createTextNode(descField));

                    var request = new XMLHttpRequest();
                    var textRequest = "/?name=" + nameField + "&desc=" + descField;
                    request.open("POST", textRequest, true);
                    request.send();

                }
            }

            function clickCancel() {
                addButton.innerHTML = "Add";
                cancel.style.display = "none";
                isAddRecord = false;
                taskTR.remove();
            }
        </script>
    @else
        you are guest, your email is {{auth()->user()->email}}
        {{$request->TaskName}}
    @endif

@endsection