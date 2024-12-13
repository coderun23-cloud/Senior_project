<h1>Search Results for "{{ $query }}"</h1>

@if($results)
    @foreach($results as $category => $items)
        <h2>{{ ucfirst($category) }}</h2>
        @if($items->isEmpty())
            <p>No results found in {{ $category }}.</p>
        @else
            <ul>
                @foreach($items as $item)
                    <li>{{ $item->name ?? $item->title ?? 'No name available' }}</li>
                @endforeach
            </ul>
        @endif
    @endforeach
@else
    <p>No results found.</p>
@endif
