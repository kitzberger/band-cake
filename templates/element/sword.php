<form method="GET" class="hide-for-print">
    <div class="row collapse">
        <div class="medium-2 large-1 columns hide-for-small-only">
            <label for="sword" class="prefix"><?= __('Search') ?></label>
        </div>
        <div class="small-10 medium-9 large-10 columns">
            <input type="text" id="sword" name="sword" placeholder="<?= __('Search ...') ?>" value="<?= h($sword) ?>" autofocus onfocus="this.select()"/>
        </div>
        <div class="small-2 medium-1 large-1 columns">
            <input type="submit" value="Go" class="button postfix" />
        </div>
    </div>
</form>
