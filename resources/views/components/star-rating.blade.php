@props(['rating'])

@php
  $fullStars = floor($rating); // Кількість повних зірок
  $halfStar = ($rating - $fullStars) >= 0.5; // Чи є половинка
  $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0); // Порожні зірки
@endphp

<div class="flex items-center space-x-1">
  {{-- Повні зірки --}}
  @for ($i = 0; $i < $fullStars; $i++)
    <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
    <path
      d="M9.049 3.293a1 1 0 011.902 0l1.705 5.058a1 1 0 00.95.69h5.343a1 1 0 01.592 1.81l-4.295 3.127a1 1 0 00-.364 1.118l1.705 5.058a1 1 0 01-1.538 1.118l-4.295-3.127a1 1 0 00-1.176 0l-4.295 3.127a1 1 0 01-1.538-1.118l1.705-5.058a1 1 0 00-.364-1.118L1.357 10.85a1 1 0 01.592-1.81h5.343a1 1 0 00.95-.69l1.705-5.058z" />
    </svg>
  @endfor

  {{-- Половина зірки --}}
  @if ($halfStar)
    <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
    <defs>
      <linearGradient id="halfStarGradient">
      <stop offset="50%" stop-color="currentColor" />
      <stop offset="50%" stop-color="gray" />
      </linearGradient>
    </defs>
    <path fill="url(#halfStarGradient)"
      d="M9.049 3.293a1 1 0 011.902 0l1.705 5.058a1 1 0 00.95.69h5.343a1 1 0 01.592 1.81l-4.295 3.127a1 1 0 00-.364 1.118l1.705 5.058a1 1 0 01-1.538 1.118l-4.295-3.127a1 1 0 00-1.176 0l-4.295 3.127a1 1 0 01-1.538-1.118l1.705-5.058a1 1 0 00-.364-1.118L1.357 10.85a1 1 0 01.592-1.81h5.343a1 1 0 00.95-.69l1.705-5.058z" />
    </svg>
  @endif

  {{-- Порожні зірки --}}
  @for ($i = 0; $i < $emptyStars; $i++)
    <svg class="w-5 h-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
    <path
      d="M9.049 3.293a1 1 0 011.902 0l1.705 5.058a1 1 0 00.95.69h5.343a1 1 0 01.592 1.81l-4.295 3.127a1 1 0 00-.364 1.118l1.705 5.058a1 1 0 01-1.538 1.118l-4.295-3.127a1 1 0 00-1.176 0l-4.295 3.127a1 1 0 01-1.538-1.118l1.705-5.058a1 1 0 00-.364-1.118L1.357 10.85a1 1 0 01.592-1.81h5.343a1 1 0 00.95-.69l1.705-5.058z" />
    </svg>
  @endfor
</div>
