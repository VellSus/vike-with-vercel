<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href="./carbon_calculator.css">    
    <title>Kalkulator Jejak Karbon</title>
    <?php echo $__env->make('layout.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
    <h1>Kalkulator Jejak Karbon</h1>
    <?php if(session('success')): ?>
        <p><?php echo e(session('success')); ?></p>
    <?php endif; ?>

    <form action="/kalkulatorkarbon" method="POST">
        <?php echo csrf_field(); ?>
        <label for="activity">Pilih Aktivitas:</label>
        <select name="activity" id="activity">
            <option value="driving">Berkendara</option>
            <option value="electricity">Penggunaan Listrik</option>
        </select>
        <br>
        <label for="distance">angka km/kwh:</label>
        <input type="number" name="number" id="number" class="<?php $__errorArgs = ['number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('number')); ?>">
        <?php $__errorArgs = ['number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="text-danger"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        <br>
        <br>
        <button type="submit">Hitung</button>
        <h4 class="mb-0 fw-bold" style="font-size:30px;"><?php echo e($carbonEmission); ?></h4>
    </form>
</body>
</html>
<?php /**PATH C:\Users\marve\SaveEarth\resources\views/carboncalculator.blade.php ENDPATH**/ ?>