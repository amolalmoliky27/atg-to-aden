<div>
<div style="position: relative; display: inline-block;">
    @php
        $reactionColor = $reactionType ? 'wheat' : '#65676B';
    @endphp

    <!-- الزر الرئيسي -->
    <button wire:click="toggleReactionMenu"
            class="{{ $reactionType ? 'reaction-active' : '' }}"
            style="padding: 5px 10px; border-radius: 20px; border: none; background: none; color: '{{ $reactionColor }}'; font-size: 15px; font-weight: 100; cursor: pointer;">
        {!! $reactionIcons[$reactionType] ?? '👍' !!} {{ $reactionLabels[$reactionType] ?? 'أعجبني' }}
    </button>

    <!-- قائمة التفاعلات المنبثقة -->
    @if($showReactionMenu)
        <div style="
            display: flex;
            position: absolute;
            bottom: 40px;
            left: 0;
            background: #fff;
            border: 1px solid #ccc;
            padding: 6px 10px;
            border-radius: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            gap: 10px;
            white-space: nowrap;
            z-index: 10;">
            @foreach($reactionLabels as $type => $label)
                <button wire:click="react('{{ $type }}')"
                        style="background: none; border: none; cursor: pointer; font-size: 22px; padding: 3px; transition: transform 0.2s;"
                        onmouseover="this.style.transform='scale(1.3)'"
                        onmouseout="this.style.transform='scale(1)'"
                        title="{{ $label }}">
                    {!! $reactionIcons[$type] !!}
                </button>
            @endforeach
        </div>
    @endif
</div>

<style>
    .reaction-active {
        color: wheat !important;
    }
</style>
</div>