<?php  $sections = App\Models\HomepageSection::where('section_type', 'section')->orderBy('position', 'asc')->get(); ?>

    <div class="bt-switch">
        <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $product_id =  explode(',', $section->product_id); ?>
        <h4>Allow <?php echo e($section->title); ?></h4>
        <div class="m-b-30">
            <input  onchange="highlightAddRemove(<?php echo e($section->id.', '.$product->id); ?>)" type="checkbox" <?php echo e(in_array($product->id, $product_id) ? 'checked' : ''); ?> data-on-color="warning" data-off-color="danger" data-on-text="Enabled" data-off-text="Disabled"> 
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- bt-switch -->
    <script src="<?php echo e(asset('assets')); ?>/node_modules/bootstrap-switch/bootstrap-switch.min.js"></script>
    <script type="text/javascript">
    $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
    var radioswitch = function() {
        var bt = function() {
            $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioState")
            }), $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck")
            }), $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck", !1)
            })
        };
        return {
            init: function() {
                bt()
            }
        }
    }();
    $(document).ready(function() {
        radioswitch.init()
    });
    </script><?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/admin/product/hightlight.blade.php ENDPATH**/ ?>