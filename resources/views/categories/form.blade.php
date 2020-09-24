<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="form-label" for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title"
                   value="{{ !empty($category) ? $category->title : old('title') }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="form-label" for="is_active">Is Active</label><br>
            <div class="checkbox-fade fade-in-primary">
                <label>
                    <input type="checkbox" value="1" name="is_active"
                        {{ isset($category) && $category->is_active == 1 ? 'checked="checked"' : '' }}>
                    <span class="cr">
                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                    </span> <span></span>
                </label>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-label" for="description">Description</label>
            <textarea rows="5" cols="5" class="form-control" name="description" id="description"
                      placeholder="Type here something...">{{ !empty($category) ? $category->description : old('description') }}</textarea>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <button type="submit" class="btn btn-primary pull-right">Submit</button>
        </div>
    </div>
</div>
