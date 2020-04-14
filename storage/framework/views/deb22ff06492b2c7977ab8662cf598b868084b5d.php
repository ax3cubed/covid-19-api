<table>
<?php $__empty_1 = true; $__currentLoopData = $apilogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<tr>
<td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo e($log->method); ?></td>
<td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($log->url); ?></td>
<td>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($log->response); ?></td>
<td>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($log->duration * 1000); ?>  ms</td>

</tr>


                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                  <?php endif; ?>

</table>

<?php /**PATH C:\xampp7\htdocs\covid-19-estimator-master\api\api\app\Providers/../../resources/views/index.blade.php ENDPATH**/ ?>