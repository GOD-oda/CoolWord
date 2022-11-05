<select name="tag_ids[]" id="tag_ids" class="form-control" multiple>
  @foreach ($tags as $tag)
    <option value="{{ $tag['id'] }}">{{ $tag['name'] }}</option>
  @endforeach
</select>
