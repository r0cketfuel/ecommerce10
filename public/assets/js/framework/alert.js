function createAlertContainer(className, message)
{
    const alertContainer = document.createElement("div");
    alertContainer.className = "alert " + className;

    const closeBtn = document.createElement("span");
    closeBtn.className = "closebtn";
    closeBtn.innerHTML = "&times;";
    
    closeBtn.onclick = function () {
        this.parentElement.style.display = 'none';
    };

    alertContainer.innerHTML = message;
    alertContainer.appendChild(closeBtn);

    return alertContainer;
}

function displayAlert(className, message)
{
    const alertContainer = createAlertContainer(className, message);
    document.body.appendChild(alertContainer);
    alertContainer.style.display = 'flex';
}