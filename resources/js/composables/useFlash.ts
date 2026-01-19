import { watch, nextTick } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { toast } from 'vue-sonner';

export function useFlash() {
    const page = usePage();

    watch(
        () => page.props.flash as any,
        async (flash) => {
            if (!flash) return;
            
            await nextTick();

            if (flash.success) {
                toast.success(flash.success);
            }
            if (flash.error) {
                toast.error(flash.error);
            }
            if (flash.info) {
                toast.info(flash.info);
            }
            if (flash.warning) {
                toast.warning(flash.warning);
            }
        },
        { deep: true, immediate: true }
    );
}
