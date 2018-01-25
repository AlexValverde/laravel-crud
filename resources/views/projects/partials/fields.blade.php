<div class="form-group">
    Project
    <input class="form-control" name="name" type="text" placeholder="Project" value="{{ $project->name }}" required/>
</div>
<div class="form-group">
    Secret
    <input class="form-control" name="secret" type="password" placeholder="Secret"  value="{{ $project->secret }}" required/>
</div>
<div class="form-group">
    Content
    <textarea class="form-control" name="content" id="" cols="30" rows="10" required>
        {{ $project->content  }}
    </textarea>
</div>
