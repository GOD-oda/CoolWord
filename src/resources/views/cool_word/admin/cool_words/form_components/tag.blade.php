<label for="tags">Tag</label>
<div class="py-1">
  @foreach ($tags as $tag)
    <input type="checkbox" class="btn-check" id="tag_id_{{ $tag['id'] }}" name="tag_ids[]" value="{{ $tag['id'] }}" autocomplete="off">
    <label class="btn btn-outline-primary rounded-pill mb-1" for="tag_id_{{ $tag['id'] }}">{{ $tag['name'] }}</label>
  @endforeach
</div>
