<?php $__env->startSection('head'); ?>
<style>
  body {
    font-family: 'Poppins';
    width: 100%;
    height: auto;
    background-image: url('/images/banner.jpg');
    background-attachment: fixed;
    background-size: cover;
  }
  .errormessage {
            color: red;
            font-size: 13px;
        }
</style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<nav class="navbar navbar-light bg-light ">
        <div style="padding-left: 40px ;">

            <table>
                <tr>
                    </a>
                    <td> <a class="navbar-brand" href="#">
                            <img src="/images/PSU_logo1.png" width="70" height="70" alt=""></td>
                    <td>
                        <h2 style="color: #0463FA;"><b>IManage: PSU URDANETA CAMPUS</b></h2>
                    </td>
                </tr>
            </table>

        </div>
</nav>


<div class="container" style="margin-top: 8%;">
  <div class="row d-flex justify-content-center">
    <div class="col-md-6 col-xl-4">
      <div class="card mb-5">
        <div class="card-body d-flex flex-column align-items-center">
          <br>
          <div class="iconn">  <img src="images/IMANAGE3.png" width="40" height="40" alt=""></div>
          <span class="sign">Log in to your account</span> <br><br>
           <form class="text-center" action="<?php echo e(route('login-user')); ?>" method="post">
          <?php if(Session::has('success')): ?>
          <div class="alert alert-success"><?php echo e(Session::get('success')); ?></div>
          <?php endif; ?>

          <?php if(Session::has('fail')): ?>
          <div class="alert alert-danger"><?php echo e(Session::get('fail')); ?></div>
          <?php endif; ?>
            <?php echo csrf_field(); ?>
            <div class="mb-3" align="left">
            <label class="form-label">Username</label>
                                    <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="errormessage"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              <input class="form-control"  name="username" placeholder="Enter Username" value="<?php echo e(@old('username')); ?>" /></div>
            <div class="mb-3"align="left"> <label class="form-label">Password</label>
                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="errormessage"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><input class="form-control" type="password" name="password" placeholder="Enter Password" value="<?php echo e(@old('password')); ?>"/>
            </div><br>
            <div class="col-6 mb-3 mx-auto"><input type="submit"  name="submit" class="btn btn-primary d-block w-100" value="LOGIN"></div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>




<?php $__env->stopSection(); ?>
<?php echo $__env->make('template.ind', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\iManageWS2\resources\views/login.blade.php ENDPATH**/ ?>