<?php
settings_fields('settings_group');
$host = rawurlencode($_SERVER['HTTP_HOST']);
$link = 'https://getchipbot.com/?utm_source=wordpress&utm_medium=plugin&utm_content=' . $host;
$nonce = wp_verify_nonce($_POST['chipbot_settings_form'], 'chipbot_form_update');
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

  <form method="post" action="options.php" style="padding: 0 15px 15px;" class="postbox">
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
              value="<?php echo get_option('chipbot_account_id') ?>"
            />
          </td>
        </tr>
      </tbody>
    </table>

      <?php
      if (isset($_POST['chipbot_settings_form']) && !$nonce) { ?>
        <div class="error">
          <p>For some reason, WordPress didn't feel like saving your data. Please try again.</p>
        </div>
      <?php } ?>

      <?php wp_nonce_field('chipbot_form_update', 'chipbot_settings_form'); ?>

      <?php submit_button(); ?>
  </form>
</div>