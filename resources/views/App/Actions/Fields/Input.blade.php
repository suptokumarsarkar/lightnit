@if(isset($input) && $input == true)
    <div class="css-1faxqwt-PopularTemplatesSection__dropdown" style="width: 100%">
        <div class="dropdown-mul-1{{$id}}">
            <input type="hidden" name="id[]" value="{{$id}}">
            <label
                for="ds2d1ds{{$id}}">{{$label}} {!! (isset($required) && $required == true) ? "<span class='required'>*</span>" : "" !!}</label>
            <input @if(isset($disabled)) disabled @endif class="form-control"
                   style='margin-top:5px; margin-bottom: 5px' name="{{$form['id']}}[]"
                   id="ds2d1ds{{$id}}"
                   placeholder="">
        </div>
        @if(isset($form['description']))
            <p class="des154">{!! $form['description'] !!}</p>
        @endif
    </div>
@elseif(isset($hidden) && $hidden == true)
    <input type="hidden" name="id[]" value="{{$id}}">
    <input type="hidden" value="{{$labelId}}" name="label{{$id}}[]">
@else
    @if(!isset($multiple))
        <div class="css-1faxqwt-PopularTemplatesSection__dropdown" style="width: 100%">
            <div class="dropdown-mul-1{{$id}}">
                <input type="hidden" name="id[]" value="{{$id}}">
                <label
                    for="ds2d1ds{{$id}}">{{$label}} {!! (isset($required) && $required == true) ? "<span class='required'>*</span>" : "" !!}</label>
                <select @if(isset($disabled)) disabled @endif style="display:none" name="label{{$id}}[]"
                        id="ds2d1ds{{$id}}" multiple
                        placeholder="Select"> </select>
            </div>

            @if(isset($form['description']))
                <p class="des154">{!! $form['description'] !!}</p>
            @endif
        </div>
    @else
        <div
            class="css-1faxqwt-PopularTemplatesSection__dropdown @if(isset($acceptDataLoad)) accpeter_dt_{{$acceptDataLoad}} @endif"
            style="width: 100%">
            <div class="dropdown-msul-1{{$id}}" style="display: block;margin-bottom: 61px;">
                <input type="hidden" name="id[]" value="{{$id}}">
                <label
                    for="ds2d1ds{{$id}}">{{$label}} {!! (isset($required) && $required == true) ? "<span class='required'>*</span>" : "" !!}</label>
                <select @if(isset($disabled)) disabled
                        @endif class="niceSelect full-width gwidth @if(isset($dataLoad)) adf15dss{{$id}} @endif"
                        style="display:none" name="label{{$id}}[]"
                        id="ds2d1ds{{$id}}"
                        placeholder="Select">
                    @foreach($form as $label => $inputs)
                        @foreach($inputs as $key => $input)
                            @foreach($input as $section => $data)
                                <option value="[{{$key}}]{{$data['id']}}"
                                        @if(isset($dataLoad)) data-load="{{$dataLoad}}"
                                        data-action="{{$dataAction}}" @endif>{{$data['name']}}</option>
                            @endforeach
                        @endforeach
                    @endforeach
                </select>
            </div>

            @if(isset($form['description']))
                <p class="des154">{!! $form['description'] !!}</p>
            @endif
        </div>
		<style>
	
.nice-select,
.nice-select.open .list {
  width: 100%;
  width: 325px;
  border-radius: 8px;
}

.nice-select .list::-webkit-scrollbar {
    width: 0
}

.nice-select .list {
    margin-top: 5px;
    top: 100%;
    border-top: 0;
    border-radius: 0 0 5px 5px;
    max-height: 210px;
    overflow-y: scroll;
    padding: 52px 0 0
}

.nice-select.has-multiple {
    white-space: inherit;
    height: auto;
    padding: 7px 12px;
    min-height: 53px;
    line-height: 22px
}

.nice-select.has-multiple span.current {
    border: 1px solid #CCC;
    background: #EEE;
    padding: 0 10px;
    border-radius: 3px;
    display: inline-block;
    line-height: 24px;
    font-size: 14px;
    margin-bottom: 3px;
    margin-right: 3px
}

.nice-select.has-multiple .multiple-options {
    display: block;
    line-height: 37px;
    margin-left: 30px;
    padding: 0
}

.nice-select .nice-select-search-box {
    box-sizing: border-box;
    position: absolute;
    width: 100%;
    margin-top: 5px;
    top: 100%;
    left: 0;
    z-index: 8;
    padding: 5px;
    background: #FFF;
    opacity: 0;
    pointer-events: none;
    border-radius: 5px 5px 0 0;
    box-shadow: 0 0 0 1px rgba(68, 88, 112, .11);
    -webkit-transform-origin: 50% 0;
    -ms-transform-origin: 50% 0;
    transform-origin: 50% 0;
    -webkit-transform: scale(.75) translateY(-21px);
    -ms-transform: scale(.75) translateY(-21px);
    transform: scale(.75) translateY(-21px);
    -webkit-transition: all .2s cubic-bezier(.5, 0, 0, 1.25), opacity .15s ease-out;
    transition: all .2s cubic-bezier(.5, 0, 0, 1.25), opacity .15s ease-out
}

.nice-select .nice-select-search {
    box-sizing: border-box;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 3px;
    box-shadow: none;
    color: #333;
    display: inline-block;
    vertical-align: middle;
    padding: 7px 12px;
    margin: 0 10px 0 0;
    width: 100%!important;
    min-height: 36px;
    line-height: 22px;
    height: auto;
    outline: 0!important
}

.nice-select.open .nice-select-search-box {
    opacity: 1;
    z-index: 10;
    pointer-events: auto;
    -webkit-transform: scale(1) translateY(0);
    -ms-transform: scale(1) translateY(0);
    transform: scale(1) translateY(0)
}

.remove:hover {
  color: red
}
</style>
        <script>
		(function($) {

    $.fn.niceSelect = function(method) {

        // Methods
        if (typeof method == 'string') {
            if (method == 'update') {
                this.each(function() {
                    var $select = $(this);
                    var $dropdown = $(this).next('.nice-select');
                    var open = $dropdown.hasClass('open');

                    if ($dropdown.length) {
                        $dropdown.remove();
                        create_nice_select($select);

                        if (open) {
                            $select.next().trigger('click');
                        }
                    }
                });
            } else if (method == 'destroy') {
                this.each(function() {
                    var $select = $(this);
                    var $dropdown = $(this).next('.nice-select');

                    if ($dropdown.length) {
                        $dropdown.remove();
                        $select.css('display', '');
                    }
                });
                if ($('.nice-select').length == 0) {
                    $(document).off('.nice_select');
                }
            } else {
                console.log('Method "' + method + '" does not exist.')
            }
            return this;
        }

        // Hide native select
        this.hide();

        // Create custom markup
        this.each(function() {
            var $select = $(this);

            if (!$select.next().hasClass('nice-select')) {
                create_nice_select($select);
            }
        });

        function create_nice_select($select) {
            $select.after($('<div></div>')
                .addClass('nice-select')
                .addClass($select.attr('class') || '')
                .addClass($select.attr('disabled') ? 'disabled' : '')
                .addClass($select.attr('multiple') ? 'has-multiple' : '')
                .attr('tabindex', $select.attr('disabled') ? null : '0')
                .html($select.attr('multiple') ? '<span class="multiple-options"></span><div class="nice-select-search-box"><input type="text" class="nice-select-search" placeholder=".."/></div><ul class="list"></ul>' : '<span class="current"></span><div class="nice-select-search-box"><input type="text" class="nice-select-search" placeholder="Поиск..."/></div><ul class="list"></ul>')
            );

            var $dropdown = $select.next();
            var $options = $select.find('option');
            if ($select.attr('multiple')) {
                var $selected = $select.find('option:selected');
                var $selected_html = '';
                $selected.each(function() {
                    $selected_option = $(this);
                    $selected_text = $selected_option.data('display') ||  $selected_option.text();

                    if (!$selected_option.val()) {
                        return;
                    }

                    $selected_html += '<span class="current">' + $selected_text + '</span>';
                });
                $select_placeholder = $select.data('js-placeholder') || $select.attr('js-placeholder');
                $select_placeholder = !$select_placeholder ? 'Select' : $select_placeholder;
                $selected_html = $selected_html === '' ? $select_placeholder : $selected_html;
                $dropdown.find('.multiple-options').html($selected_html);
            } else {
                var $selected = $select.find('option:selected');
                $dropdown.find('.current').html($selected.data('display') ||  $selected.text());
            }


            $options.each(function(i) {
                var $option = $(this);
                var display = $option.data('display');

                $dropdown.find('ul').append($('<li></li>')
                    .attr('data-value', $option.val())
                    .attr('data-display', (display || null))
                    .addClass('option' +
                        ($option.is(':selected') ? ' selected' : '') +
                        ($option.is(':disabled') ? ' disabled' : ''))
                    .html($option.text())
                );
            });
        }

        /* Event listeners */

        // Unbind existing events in case that the plugin has been initialized before
        $(document).off('.nice_select');

        // Open/close
        $(document).on('click.nice_select', '.nice-select', function(event) {
            var $dropdown = $(this);

            $('.nice-select').not($dropdown).removeClass('open');
            $dropdown.toggleClass('open');

            if ($dropdown.hasClass('open')) {
                $dropdown.find('.option');
                $dropdown.find('.nice-select-search').val('');
                $dropdown.find('.nice-select-search').focus();
                $dropdown.find('.focus').removeClass('focus');
                $dropdown.find('.selected').addClass('focus');
                $dropdown.find('ul li').show();
            } else {
                $dropdown.focus();
            }
        });

        $(document).on('click', '.nice-select-search-box', function(event) {
            event.stopPropagation();
            return false;
        });
        $(document).on('keyup.nice-select-search', '.nice-select', function() {
            var $self = $(this);
            var $text = $self.find('.nice-select-search').val();
            var $options = $self.find('ul li');
            if ($text == '')
                $options.show();
            else if ($self.hasClass('open')) {
                $text = $text.toLowerCase();
                var $matchReg = new RegExp($text);
                if (0 < $options.length) {
                    $options.each(function() {
                        var $this = $(this);
                        var $optionText = $this.text().toLowerCase();
                        var $matchCheck = $matchReg.test($optionText);
                        $matchCheck ? $this.show() : $this.hide();
                    })
                } else {
                    $options.show();
                }
            }
            $self.find('.option'),
                $self.find('.focus').removeClass('focus'),
                $self.find('.selected').addClass('focus');
        });

        // Close when clicking outside
        $(document).on('click.nice_select', function(event) {
            if ($(event.target).closest('.nice-select').length === 0) {
                $('.nice-select').removeClass('open').find('.option');
            }
        });

        // Option click
        $(document).on('click.nice_select', '.nice-select .option:not(.disabled)', function(event) {
            
            var $option = $(this);
            var $dropdown = $option.closest('.nice-select');
            if ($dropdown.hasClass('has-multiple')) {
                if ($option.hasClass('selected')) {
                    $option.removeClass('selected');
                } else {
                    $option.addClass('selected');
                }
                $selected_html = '';
                $selected_values = [];
                $dropdown.find('.selected').each(function() {
                    $selected_option = $(this);
                    var attrValue = $selected_option.data('value');
                    var text = $selected_option.data('display') ||  $selected_option.text();
                    $selected_html += (`<span class="current" data-id=${attrValue}> ${text} <span class="remove">X</span></span>`);
                    $selected_values.push($selected_option.data('value'));
                });
                $select_placeholder = $dropdown.prev('select').data('js-placeholder') ||                                   $dropdown.prev('select').attr('js-placeholder');
                $select_placeholder = !$select_placeholder ? 'Select' : $select_placeholder;
                $selected_html = $selected_html === '' ? $select_placeholder : $selected_html;
                $dropdown.find('.multiple-options').html($selected_html);
                $dropdown.prev('select').val($selected_values).trigger('change');
            } else {
                $dropdown.find('.selected').removeClass('selected');
                $option.addClass('selected');
                var text = $option.data('display') || $option.text();
                $dropdown.find('.current').text(text);
                $dropdown.prev('select').val($option.data('value')).trigger('change');
            }
          console.log($('.mySelect').val())
        });
      //---------remove item
      $(document).on('click','.remove', function(){
        var $dropdown = $(this).parents('.nice-select');
        var clickedId = $(this).parent().data('id')
        $dropdown.find('.list li').each(function(index,item){
          if(clickedId == $(item).attr('data-value')) {
            $(item).removeClass('selected')
          }
        })
        $selected_values.forEach(function(item, index, object) {
          if (item === clickedId) {
            object.splice(index, 1);
          }
        });
        $(this).parent().remove();
        console.log($('.mySelect').val())
       })
      
        // Keyboard events
        $(document).on('keydown.nice_select', '.nice-select', function(event) {
            var $dropdown = $(this);
            var $focused_option = $($dropdown.find('.focus') || $dropdown.find('.list .option.selected'));

            // Space or Enter
            if (event.keyCode == 32 || event.keyCode == 13) {
                if ($dropdown.hasClass('open')) {
                    $focused_option.trigger('click');
                } else {
                    $dropdown.trigger('click');
                }
                return false;
                // Down
            } else if (event.keyCode == 40) {
                if (!$dropdown.hasClass('open')) {
                    $dropdown.trigger('click');
                } else {
                    var $next = $focused_option.nextAll('.option:not(.disabled)').first();
                    if ($next.length > 0) {
                        $dropdown.find('.focus').removeClass('focus');
                        $next.addClass('focus');
                    }
                }
                return false;
                // Up
            } else if (event.keyCode == 38) {
                if (!$dropdown.hasClass('open')) {
                    $dropdown.trigger('click');
                } else {
                    var $prev = $focused_option.prevAll('.option:not(.disabled)').first();
                    if ($prev.length > 0) {
                        $dropdown.find('.focus').removeClass('focus');
                        $prev.addClass('focus');
                    }
                }
                return false;
                // Esc
            } else if (event.keyCode == 27) {
                if ($dropdown.hasClass('open')) {
                    $dropdown.trigger('click');
                }
                // Tab
            } else if (event.keyCode == 9) {
                if ($dropdown.hasClass('open')) {
                    return false;
                }
            }
        });

        // Detect CSS pointer-events support, for IE <= 10. From Modernizr.
        var style = document.createElement('a').style;
        style.cssText = 'pointer-events:auto';
        if (style.pointerEvents !== 'auto') {
            $('html').addClass('no-csspointerevents');
        }

        return this;

    };

}(jQuery));    
 
            $("#ds2d1ds{{$id}}").niceSelect();
            @if(isset($dataLoad))
            $(".adf15dss{{$id}}").load(function () {
            });
            $(".adf15dss{{$id}}").change(function () {
                let attr = $(this).find('option:selected').attr('data-load');
                let dataAction = $(this).find('option:selected').attr('data-action');
                if (typeof attr !== 'undefined' && attr !== false) {
                    $.ajax({
                        url: '{{route("getExtraDataField")}}/' + attr + "/okay",
                        method: 'POST',
                        data: "dataAction="+dataAction+"&"+$("#{{isset($formName) ? $formName : 'triggerForm'}}").serialize(),
                        beforeSend: function () {
                            showLoader();
                        },
                        success: function (data) {
                            hideLoader();
                            $(".accpeter_dt_" + data.id).not(':first').remove();
                            $(".accpeter_dt_" + data.id).replaceWith(data.view);
                        },
                        error: function () {
                            hideLoader();
                        }
                    });
                }
            });
            $(".adf15dss{{$id}}").change();
            @endif
        </script>
    @endif
@endif
