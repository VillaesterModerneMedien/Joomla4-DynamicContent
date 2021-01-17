(function (Vue) {

  Vue.events.on('openItemPicker', function (e, options) {

    if (options.module !== 'contact') {
      return;
    }

    e.stopPropagation();

    const modal = e.origin.$modal({
      render: function(createElement) {

        return createElement('div', {
          attrs: {
            'uk-overflow-auto': ''
          },
          on: {
            resize: function(e) {
              e.target.firstElementChild.style.height = e.target.style.maxHeight;
            }
          }
        }, [createElement('iframe', {
          attrs: {
            src: Vue.url('administrator/index.php?option=com_contact&view=contacts&layout=modal&tmpl=component', {
              function: 'pickStudioItem',
              app_id: e.origin.values.appid,
              type_filter: options.item_type
            })
          },
          on : {
            load: function(e) {
              e.target.contentDocument.body.style.padding = '30px'
            }
          },
          style: 'width: 100%'
        })]);

      }
    });

    window.pickStudioItem = function(id) {
      modal.resolve(id);
      delete window.pickStudioItem;
    };

    return modal.show({container: true});

  }, 5);

  Vue.events.on('resolveItemTitle', function (e, module) {

    if (e.origin.field.module !== 'contact') {
      return;
    }

    e.stopPropagation();

    return e.origin.$http.get('contact/contacts', {params: {ids: [module.id]}}).then(function(response) {
      return response.body[module.id];
    });

  }, 5);

})(window.Vue)
