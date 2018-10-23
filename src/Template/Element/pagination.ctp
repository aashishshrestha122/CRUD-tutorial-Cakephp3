    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?php if($this->Paginator->hasPrev()){
            echo $this->Paginator->prev('< ' . __('previous')); 
            }?>
            <?= $this->Paginator->numbers() ?>
            <?php  if($this->Paginator->hasNext()){
                echo $this->Paginator->next(__('next') . ' >'); }?>
            <?php echo $this->Paginator->last(__('last') . ' >>');
            ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>