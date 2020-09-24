<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-label" for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title"
                   value="{{ !empty($product) ? $product->title : old('title') }}">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-label" for="picture">
                Picture
            </label>
            @if(isset($product) && !empty($product->picture))
                <a href="{{ asset('uploads/products/' . $product->picture) }}"
                   target="_blank" class="float-right">
                    Link
                </a>
            @endif
            <input type="file" class="form-control" id="picture" name="picture"
                   value="{{ isset($product) && !empty($product) ? $product->picture : '' }}">
            <input type="hidden" name="old_picture"
                   value="{{ isset($product) && !empty($product) ? $product->picture : '' }}">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-label" for="is_active">Is Active</label><br>
            <div class="checkbox-fade fade-in-primary">
                <label>
                    <input type="checkbox" value="1" name="is_active"
                        {{ isset($product) && $product->is_active == 1 ? 'checked="checked"' : '' }}>
                    <span class="cr">
                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                    </span> <span></span>
                </label>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-label" for="is_featured">Is Featured</label><br>
            <div class="checkbox-fade fade-in-primary">
                <label>
                    <input type="checkbox" value="1" name="is_featured"
                        {{ isset($product) && $product->is_featured == 1 ? 'checked="checked"' : '' }}>
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
            <label class="form-label" for="category_ids">Categories</label>
            <select name="category_ids[]" id="category_ids" class="form-control" multiple>
                @foreach(\App\Models\Category::where('is_active', 1)->get() as $category)
                    <option value="{{ $category->id }}"
                        {{ !empty($category_ids) && in_array($category->id, $category_ids) ? 'selected="selected"' : '' }}
                    >{{ $category->title }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-label" for="description">Description</label>
            <textarea rows="5" cols="5" class="form-control" name="description" id="description"
                      placeholder="Type here something...">{{ !empty($product) ? $product->description : old('description') }}</textarea>
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
