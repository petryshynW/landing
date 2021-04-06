<div class="wrapper content-fluid">
    <form action="{{route('pageEdit',array('page'=>$data['id']))}}" class="form-horizontal" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$data['id']}}">
        <div class="form-group">
            <label for="name" class="col-xs-2 control-label">Назва</label>
            <div class="col-xs-8">
                <input type="text" name="name" value="{{$data['name']}}" class="form-control" placeholder="Введіть назву сторінки">
            </div>
        </div>
        <div class="form-group">
            <label for="alias" class="col-xs-2 control-label">Псевдонім:</label>
            <div class="col-xs-8">
                <input type="text" name="alias" value="{{$data['alias']}}" class="form-control" placeholder="Псевдонім сторінки">
            </div>
        </div>
        <div class="form-group">
            <label for="text" class="col-xs-2 control-label">Текст:</label>
            <div class="col-xs-8">
                <input type="text" name="text" value="{{$data['text']}}" id="editor" class="form-control" placeholder="Текст">
            </div>
        </div>
        <div>
            <label for="old_image" class="col-xs-2 control-label">Картинка:</label>
            <div class="col-xs-offset-2 col-xs-10">
                <img src="{{asset('assets/img/'.$data['images'])}}" class="img-rounded">
                <input type="hidden" name="old_image" value="{{$data['images']}}">
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
        CKEDITOR.instances.editor.setData(document.getElementById('editor').value) ;
       $('form').on('submit',function (){
            document.getElementById('editor').value = CKEDITOR.instances.editor.getData();

        })


    </script>
</div>
