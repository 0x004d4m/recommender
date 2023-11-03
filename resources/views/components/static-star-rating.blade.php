@props(['rating'])

<div class="flex items-center">
    @foreach(range(1, 5) as $star)
        <svg class="{{ $star <= $rating ? 'text-yellow-400' : 'text-gray-300' }} w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <title>{{ $star }} star</title>
            <path d="M9.049 2.927c.3-.9 1.652-.9 1.952 0l1.478 4.525c.15.46.634.77 1.113.77h4.764c.92 0 1.304 1.12.63 1.69l-3.852 2.796c-.34.246-.48.695-.35 1.095l1.445 4.416c.27.82-.69 1.5-1.41.98l-3.766-2.733c-.42-.305-.995-.305-1.415 0l-3.766 2.733c-.72.52-1.68-.16-1.41-.98l1.445-4.416c.13-.4-.01-.85-.35-1.095L2.193 9.912c-.674-.57-.29-1.69.63-1.69h4.764c.48 0 .963-.31 1.113-.77l1.478-4.525z"/>
        </svg>
    @endforeach
</div>
