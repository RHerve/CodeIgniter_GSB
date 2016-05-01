<div class="wrap-block-login">
<div class="content-block-login">
    <div class="block-login"> 
    <?php echo validation_errors(); ?>

       <?php echo form_open('controlleur_principal/connexion'); ?>
        
        <div class="logo">
          <img src="<?php echo base_url();?>assets/img/logo-gsb-new-login.png">
        </div>
          <span class="input input--hoshi">
               <input class="input__field input__field--hoshi" type="text" id="input-4" name="login" required/>
              <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                   <span class="input__label-content input__label-content--hoshi">Login</span>
               </label>
        </span>
        <span class="input input--hoshi">
               <input class="input__field input__field--hoshi" type="password" id="input-4" name="mdp" required/>
              <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                  <span for="mdp" class="input__label-content input__label-content--hoshi">Mot de passe</span>
              </label>
        </span>

        <?php if (isset($message)){ echo '<div class=\"erreur\">'.$message.'</div>'; } ?>
           <input type="submit" value="Se connecter" name="valider">
    </form>


    <script>
      (function() {
        // trim polyfill : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/Trim
        if (!String.prototype.trim) {
          (function() {
            // Make sure we trim BOM and NBSP
            var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
            String.prototype.trim = function() {
              return this.replace(rtrim, '');
            };
          })();
        }

        [].slice.call( document.querySelectorAll( 'input.input__field' ) ).forEach( function( inputEl ) {
          // in case the input is already filled..
          if( inputEl.value.trim() !== '' ) {
            classie.add( inputEl.parentNode, 'input--filled' );
          }

          // events:
          inputEl.addEventListener( 'focus', onInputFocus );
          inputEl.addEventListener( 'blur', onInputBlur );
        } );

        function onInputFocus( ev ) {
          classie.add( ev.target.parentNode, 'input--filled' );
        }

        function onInputBlur( ev ) {
          if( ev.target.value.trim() === '' ) {
            classie.remove( ev.target.parentNode, 'input--filled' );
          }
        }
      })();
    </script>


    </div>

    </div>