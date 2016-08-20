$(document).foundation()

$(function(){
      $('table.sortable > tbody > tr:odd').addClass('odd');
      
      $('table.sortable > tbody > tr').hover(function(){
        $(this).toggleClass('hover');
      });
      
      $('table.sortable > tbody > tr > td > :checkbox').bind('click change', function(){
        var tr = $(this).parent().parent();
        if($(this).is(':checked')) $(tr).addClass('selected');
        else $(tr).removeClass('selected');
      });
      
      $('form#dashboard-search').submit(function(e){ e.preventDefault(); });
      
      $('input#search').keydown(function(){
        var encontrou = false;
        var termo = $(this).val().toLowerCase();
        $('table.sortable > tbody > tr').each(function(){
          $(this).find('td').each(function(){
            if($(this).text().toLowerCase().indexOf(termo) > -1) encontrou = true;
          });
          if(!encontrou) $(this).hide();
          else $(this).show();
          encontrou = false;
        });
      });
      
      $("table.sortable") 
        .tablesorter({
          dateFormat: 'uk',
          headers: {
            0: {
              sorter: false
            },
            5: {
              sorter: false
            }
          }
        }) 
        .tablesorterPager({container: $("#pager")})
        .bind('sortEnd', function(){
          $('table.sortable > tbody > tr').removeClass('odd');
          $('table.sortable > tbody > tr:odd').addClass('odd');
        });
      $("th > div").append('<i class="fa fa-sort-asc"></i><i class="fa fa-sort-desc"></i>');

      //multiselect
      $('.multiselect').multiSelect({
        keepOrder: true,
        selectableHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='Pesquisar camadas...'>",
        selectionHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='Pesquisar camadas selecionadas...'>",
        afterInit: function(ms){
          var that = this,
              $selectableSearch = that.$selectableUl.prev(),
              $selectionSearch = that.$selectionUl.prev(),
              selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
              selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

          that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
          .on('keydown', function(e){
            if (e.which === 40){
              that.$selectableUl.focus();
              return false;
            }
          });

          that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
          .on('keydown', function(e){
            if (e.which == 40){
              that.$selectionUl.focus();
              return false;
            }
          });
        },
        afterSelect: function(){
          this.qs1.cache();
          this.qs2.cache();
        },
        afterDeselect: function(){
          this.qs1.cache();
          this.qs2.cache();
        }
      });
});

window.onload = function(){
    tinymce.init({
          selector: "textarea.editor",
          theme: "modern",
          language: "pt_BR",
          menubar : false,
          relative_urls: false,
          convert_urls: false,
          toolbar1: "undo redo | styleselect  forecolor | bold italic strikethrough blockquote numlist bullist | alignleft aligncenter alignright alignjustify | link unlink media image fullscreen preview code",
          plugins: [
               "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
               "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
               "save table contextmenu directionality emoticons template paste textcolor"
          ],
          image_advtab: true,
          paste_word_valid_elements: "b,strong,i,em,h1,h2",
        style_formats: [
              {title: "Parágrafo", inline: "p"},
              {title: "Título H1", block: "h1"},
              {title: "Título H2", block: "h2"},
              {title: "Título H3", block: "h3"},
              {title: "Título H4", block: "h4"},
              {title: "Destaque", inline: "span", styles: {color: "#ff0000"}},
          ],
          content_css: [
            '../css/foundation.min.css',
          ]
      });
}