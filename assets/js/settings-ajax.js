async function getSetting(option) {
  const { _, data } = await jQuery.get(contacts_manager_ajax.ajax_url, {
    action: "cm_get_setting",
    _ajax_nonce: contacts_manager_ajax.nonce,
    option_name: option,
  });

  return data;
}
