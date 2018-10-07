<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

settings_fields('settings_group');
$host = rawurlencode($_SERVER['HTTP_HOST']);
$path = rawurlencode($_SERVER['REQUEST_URI']);
$link = 'https://getchipbot.com/?utm_source=wordpress&utm_medium=plugin&utm_content=' . $host . $path;
$nonce = wp_verify_nonce($_POST['chipbot_settings_form'], 'chipbot_form_update');
$queries = array();
parse_str($_SERVER['QUERY_STRING'], $queries);
$adminPath = get_admin_url() . 'admin.php?page=getchipbot-com&saved=true';
?>

<div class="wrap">
  <div class="postbox" style="padding: 15px;">
    <img
      style="margin-bottom: 10px;"
      src="https://static.getchipbot.com/shared/images/cb-logo-2.svg"
      alt="GetChipBot.com"
    />

    <h3>Thanks for trying out ChipBot</h3>
    <p>
      If you don't have an Account ID, sign up at
      <a href="<?php echo $link; ?>" target="_blank" rel="noreferrer noopener nofollow">https://getchipbot.com</a>.
      It takes less than
      a few minutes to get this setup!
    </p>

    <a class="button button-primary" href="<?php echo $link; ?>" target="_blank"
      rel="noreferrer noopener nofollow">
      Sign Up
    </a>
  </div>

  <form
    method="post"
    action="options.php"
    style="padding: 0 15px 15px;"
    class=""
  >

    <h3>ChipBot Account Setup</h3>
      <?php
      settings_fields('settings_group');
      ?>

    <table class="form-table">
      <tbody>
        <tr>
          <td>
            Account ID
          </td>
          <td>
            <input
              name="chipbot_account_id"
              id="chipbot_account_id"
              type="text"
              class="regular-text"
              value="<?php echo $queries['account-id'] ? $queries['account-id'] : get_option('chipbot_account_id') ?>"
            />

            <script type="text/javascript">
              function onBlurCorrection(e) {
                const userCopiedScriptNotAccountId = (e.target.value || '').match(/id(?=\=(.*)\")/);

                if (userCopiedScriptNotAccountId) {
                  e.target.value = userCopiedScriptNotAccountId[1] || '';
                  alert('We are converting the script tag to your account ID. Click "Save Changes" to see ChipBot on your homepage.');
                }
              }

              document.querySelector('input[id="chipbot_account_id"]')
                .addEventListener('blur', onBlurCorrection, false);
            </script>
          </td>
        </tr>
      </tbody>
    </table>

    <input
      type="hidden"
      name="_wp_http_referer"
      value="<?php echo $adminPath ?>"
    >


      <?php if ($queries['saved']) { ?>
        <div class="notice notice-success" style="padding: 20px;">
          Your Account ID is now saved! Go check your homepage to see Chipbot.
        </div>
      <?php } ?>

      <?php
      if (isset($_POST['chipbot_settings_form']) && !$nonce) { ?>
        <div class="error">
          <p>For some reason, WordPress didn't feel like saving your data. Please try again.</p>
        </div>
      <?php } ?>

      <?php wp_nonce_field('chipbot_form_update', 'chipbot_settings_form'); ?>

    <input type="hidden" name="_wp_http_referer"
      value="<?php echo $adminPath ?>">


    <div class="chipbot-submit">
        <?php submit_button(); ?>
    </div>

      <?php if (isset($queries['account-id']) && !isset($queries['settings-updated']) && $queries['account-id'] !== get_option('chipbot_account_id')) { ?>
        <script type="text/javascript">
          document.querySelector('.chipbot-submit input[type="submit"]').click();
        </script>
      <?php } ?>

    <p>
      For support, you can reach us directly on
      <a href="https://getchipbot.com?utm_source=wordpress&utm_medium=support" target="_blank"
        rel="noreferrer noopener nofollow">https://getchipbot.com</a>
      or email
      <a href="mailto:support@getchipbot.com">support@getchipbot.com</a>.
    </p>
  </form>
</div>