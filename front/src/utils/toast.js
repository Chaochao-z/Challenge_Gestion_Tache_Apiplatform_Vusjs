import { useToast } from "vue-toastification";
const toast = useToast();

const options = {
  position: "bottom-right",
  timeout: 5000,
  closeOnClick: true,
  pauseOnFocusLoss: true,
  pauseOnHover: true,
  draggable: true,
  draggablePercent: 0.6,
  showCloseButtonOnHover: false,
  hideProgressBar: true,
  closeButton: "button",
  icon: true,
  rtl: false,
};

export const displayMsg = ({msg, type = "default"}) => {
  switch (type) {
    case "success":
      toast.success(msg, options);
      break;
    case "error":
      toast.error(msg, options);
      break;
    case "warning":
      toast.warning(msg, options);
      break;
    default:
      toast(msg, options);
  }
};
