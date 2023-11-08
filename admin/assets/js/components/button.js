import { ref, computed } from 'vue'
export default {
    props: {
    type: {
        type: String,
        default: "primary",
            validator: function (value) {
                return (
                [
                    "primary",
                    "default",
                    "error",
                    "light",
                    "dark",
                ].indexOf(value) !== -1
                );
            },
        },
        variant: {
            type: String,
            default: "default",
                validator: function (value) {
                    return (
                    [
                        "default",
                        "ghost",
                        "clear",
                    ].indexOf(value) !== -1
                    );
                },
            },
        alignText: {
        type: String,
        default: "center",
        },
        disabled: {
        type: Boolean,
        default: false,
        },
        icon: {
        type: String,
        required: false,
        },
        fullWidth: {
        type: Boolean,
        required: false,
        },
        iconPosition: {
        type: String,
        default: "left",
        validator: function (value) {
            return ["left", "right"].indexOf(value) !== -1;
        },
        },
        anchor: {
        type: Boolean,
        default: false,
        },
        submit: {
        type: Boolean,
        default: false,
        },
        classes: {
        type: String,
        default: "",
        },
        roundButton: {
        type: Boolean,
        default: false,
        },
        label: {
        type: String,
        default: "",
    },
},
setup(props) {
    const classes = computed(() => {
        let classes = '';

        const themes = {
            default: {
                primary: 'bg-primary text-white hover:opacity-80',
                secondary: 'bg-secondary-200 text-secondary-700 hover:opacity-80',
                success: 'bg-success text-white hover:bg-success-light',
                error: 'bg-error text-white hover:opacity-80',
            },
            ghost: {
                primary: 'border-2 text-primary border-primary hover:bg-primary-light hover:text-white',
                secondary: 'border-2 border-secondary hover:bg-secondary-light hover:text-white',
                success: 'border-2 text-success border-success hover:bg-success-light hover:text-white',
                error: 'border-2 text-error border-error hover:bg-error-light hover:text-white',
            },
            clear: {
                primary: 'text-primary hover:bg-primary-light',
                secondary: 'text-secondary hover:bg-secondary-light',
                success: 'bg-success text-white hover:opacity-80',
                error: 'text-error hover:bg-error-light',
            },
        };

        classes += ` ${themes[props.variant][props.type]}`;

        return classes;
      });

      const iconClasses = computed(() => {
        return [props.icon, props.iconPosition === 'right' ? 'order-2' : '']
      });

    return { classes, iconClasses }
},
  template: `
    <button class="p-3 rounded-md" :class="classes" v-if="!anchor">
        <div class="flex gap-2 items-center">
        <template v-if="icon">
            <slot name="icon">
                <i :class="iconClasses"></i>
            </slot>
        </template>
        <slot>
            {{ label }}
        </slot>
        </div>
    </button>
    <a v-else class="p-3 rounded-md" :class="classes">
        <slot>
            {{ label }}
        </slot>
    </a>
    `
}

{/* <span class="flex items-center">
            <template v-if="icon">
                <slot name="icon">
                <i :class="iconClasses"></i>
                </slot>
            </template>
            <slot>
                {{ label }}
            </slot>
        </span> */}