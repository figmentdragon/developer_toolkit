@mixin badge-variant($bg)
{
    color: color-yiq($bg);
    background-color: $bg;

    @at-root a#{&}
    {
        @include hover-focus()
        {
            color: color-yiq($bg);
            background-color: darken($bg, 10%);
        }

        &:focus,
        &.focus
        {
            outline: 0;
            box-shadow: 0 0 0 $badge-focus-width rgba($bg, .5);
        }
    }
}
