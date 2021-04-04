<div class="wrapper content-fluid">
     <form action="{{route('pageAdd')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
         @csrf
        <div class="form-group">
            <label for="name" class="col-xs-2 control-label">Назва</label>
            <div class="col-xs-8">
                <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Введіть назву сторінки">
            </div>
        </div>
        <div class="form-group">
            <label for="alias" class="col-xs-2 control-label">Псевдонім:</label>
            <div class="col-xs-8">
                <input type="text" name="alias" value="{{old('alias')}}" class="form-control" placeholder="Псевдонім сторінки">
            </div>
        </div>
        <div class="form-group">
            <label for="text" class="col-xs-2 control-label">Текст:</label>
            <div class="col-xs-8">
                <input type="text" name="text" value="{{old('text')}}" id="editor" class="form-control" placeholder="Текст">
            </div>
        </div>
        <div class="form-group">
            <label for="images" class="col-xs-2 control-label">Картинка:</label>
            <div class="col-xs-8">
                <input type="file" name="images"  class="filestyle" data-buttonText="Виберіть зображення" data-buttonName="btn-primary" data-Placeholder="Файл не вибрано">
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-offset-2 col-xs-10">
                <input type="submit" value="Зберегти" class="btn-primary">
            </div>
        </div>
     </form>
    <script>
        CKEDITOR.replace('editor');
       /* $('form').on('submit',function (){
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            document.getElementById('hiddenText').value = 'asdada';
        })*/
        $('form').on('submit',function (){
            document.getElementById('editor').value = CKEDITOR.instances.editor.getData();

            //document.getElementById('hiddenText').value = 'asdada';
        })


    </script>
</div>
