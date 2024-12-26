/***********************************************
 * Global Variables and DOM Elements
 **********************************************/
// Navigation and Menu Elements
const menuLi = document.querySelectorAll('header ul li a');
const section = document.querySelectorAll('section');
const header = document.querySelector("header");
const menuIcon = document.querySelector("#menu-icon");
const navlist = document.querySelector(".navlist");


// Cart Elements
const shopContainer = document.querySelector('.shop-container');
const cartIcon = document.querySelector('.cart-icon');
const cartCount = document.querySelector('.cart-count');
const cart = document.querySelector('.Cart');
const closeCartButton = document.getElementById('close-cart');
const buyButton = document.querySelector('.btn-buy');
const searchBar = document.querySelector('.search-bar');
const categoriesList = document.querySelector('.categories-list');

// Other Elements
const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            entry.target.classList.add("show-items");
        } else {
            entry.target.classList.remove("show-items");
        }
    });
});
const scrollScale = document.querySelectorAll(".scroll-scale");
scrollScale.forEach((el) => observer.observe(el));

/***********************************************
 * 1. Navigation and Header
 **********************************************/

/** Highlights the active menu item based on the current page */
function setActivePage() {
    const currentPage = window.location.pathname.split("/").pop();
    const menuLinks = document.querySelectorAll(".navlist a");

    menuLinks.forEach(link => link.classList.remove("active"));
    menuLinks.forEach(link => {
        if (link.getAttribute("href") === currentPage) {
            link.classList.add("active");
        }
    });
}

/** Toggles sticky header on scroll */
window.addEventListener("scroll", function() {
    header.classList.toggle("sticky", window.scrollY > 50);
});

/** Toggles the navbar visibility for mobile devices */
menuIcon.onclick = () => {
    menuIcon.classList.toggle("bx-x");
    navlist.classList.toggle("open");
};

/** Closes the navbar when scrolling or clicking outside */
window.onscroll = closeNavbar;
navlist.addEventListener('click', closeNavbar);

function closeNavbar() {
    menuIcon.classList.remove("bx-x");
    navlist.classList.remove("open");
}

// Initialize navigation highlights
document.addEventListener('DOMContentLoaded', setActivePage);




/*****************************************************************************************************
 * THEME MANAGEMENT AND MANIPULATION JAVASCRIPT GOES HERE
 ***************************************************************/
// Theme management
const themes = {
    light: 'light-theme',
    colored: 'colored-theme',
    dark: 'dark-theme'
};

// Initialize theme from localStorage or default to light
document.addEventListener('DOMContentLoaded', () => {
    const savedTheme = localStorage.getItem('theme') || 'light';
    setTheme(savedTheme);
});

// Add click handlers to theme buttons
document.querySelectorAll('.theme-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const theme = btn.dataset.theme;
        setTheme(theme);
    });
});

function setTheme(theme) {
    // Remove all theme classes
    Object.values(themes).forEach(className => {
        document.body.classList.remove(className);
    });
    
    // Add selected theme class
    document.body.classList.add(themes[theme]);
    
    // Save theme preference
    localStorage.setItem('theme', theme);
}





/*****************************************************************************
 * 5. FLOATING CHATBOX SECTION JAVASCRIPT GOES HERE
 ****************************************************************************/
class ChatBox {
    constructor() {
        this.chatIcon = document.querySelector('.chat-icon');
        this.chatContainer = document.querySelector('.chatbox-container');
        this.closeBtn = document.querySelector('.close-btn');
        this.messageContainer = document.querySelector('.chatbox-messages');
        this.inputField = document.querySelector('.chatbox-input input');
        this.sendButton = document.querySelector('.chatbox-input button');

        this.initEventListeners();
    }

    initEventListeners() {
        this.chatIcon.addEventListener('click', () => this.toggleChatbox());
        this.closeBtn.addEventListener('click', () => this.toggleChatbox());
        this.sendButton.addEventListener('click', () => this.sendMessage());
        this.inputField.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') this.sendMessage();
        });
    }

    toggleChatbox() {
        this.chatContainer.classList.toggle('active');
        this.scrollToBottom();
    }

    sendMessage() {
        const messageText = this.inputField.value.trim();
        if (!messageText) return;

        this.renderMessage(messageText, 'user');
        this.inputField.value = '';
        this.scrollToBottom();

        // Simulate bot response (replace with actual AI/backend logic)
        setTimeout(() => {
            this.renderMessage(this.generateBotResponse(messageText), 'bot');
            this.scrollToBottom();
        }, 1000);
    }

    renderMessage(text, sender) {
        const messageEl = document.createElement('div');
        messageEl.classList.add('message', sender);
        messageEl.innerHTML = `
            <div class="message-content">
                ${text}
            </div>
        `;
        this.messageContainer.appendChild(messageEl);
    }

    scrollToBottom() {
        this.messageContainer.scrollTop = this.messageContainer.scrollHeight;
    }

    generateBotResponse(userMessage) {
        // Basic response generation logic
        const lowerMessage = userMessage.toLowerCase();
        const responses = {
            'hi': 'Hello! How can I help you today?',
            'hello': 'Hi there! What can I do for you?',
            'help': 'Sure, I\'m here to assist you. What do you need help with?',
            'could you assist me': 'Sure, I\'m here to assist you. How can I assist you?',
            'do you do deliveries': 'Yes, we print, brand and design and do deliveries to your desired destination or location',
            'I have a problem': 'What is the problem? I\'m here to be of help to you',
            'bye': 'Goodbye! Have a great day.',
            'thanks': 'You\'re welcome!'
        };

        for (const [key, response] of Object.entries(responses)) {
            if (lowerMessage.includes(key)) return response;
        }

        return "I'm not sure how to respond to that. Could you rephrase?";
    }
}

// Initialize chatbox when DOM is fully loaded
document.addEventListener('DOMContentLoaded', () => {
    new ChatBox();
});





/**************************************************************************************************************
 * 4. SECOND HEADER (TOP BAR) JAVASCRIPT GOES HERE
********************************************************************************************/
document.addEventListener('DOMContentLoaded', () => {
    let lastScrollPosition = 0;
    let ticking = false;
    const secheader = document.querySelector('#second-header .topbar');
    const scrollThreshold = 100; // Adjust this value to determine how far down the page the user needs to scroll before the header hides

    function updateHeader() {
        const currentScrollPosition = window.pageYOffset;
        
        if (secheader) {
            // Scrolling down
            if (currentScrollPosition > lastScrollPosition && currentScrollPosition > scrollThreshold) {
                secheader.classList.add('hidden');
            }
            // Scrolling up and near the top
            else if (currentScrollPosition < lastScrollPosition && currentScrollPosition < scrollThreshold) {
                secheader.classList.remove('hidden');
            }
        } else {
            console.error('Element #second-header .topbar not found');
        }
        
        lastScrollPosition = currentScrollPosition;
        ticking = false;
    }

    // Add scroll event listener with requestAnimationFrame for better performance
    window.addEventListener('scroll', () => {
        if (!ticking) {
            window.requestAnimationFrame(() => {
                updateHeader();
            });
            ticking = true;
        }
    });
});








/***********************************************
 * 5. ALL SWIPER SLIDER JAVASCRIPTS GO HERE
**********************************************/
document.addEventListener('DOMContentLoaded', function() {
    new Swiper('.promotions .promo-details .promo-banners .swiper', {
        loop: true,
        autoplay: {
            delay: 3000, // Change slide every 3 seconds
            disableOnInteraction: false
        },
        slidesPerView: 1,
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        }
    });
});

/***********************************************
**********************************************/
document.addEventListener('DOMContentLoaded', function () {
    new Swiper('.promotions .promo-bottom .swiper', {
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false
        },
        slidesPerView: 'auto',
        spaceBetween: 24,
        breakpoints: {
            // Mobile
            768: {
                slidesPerView: 3,
                spaceBetween: 24
            },
            // Tablet/Desktop
            1024: {
                slidesPerView: 4,
                spaceBetween: 24
            }
        }
    });
});

/***********************************************
**********************************************/





/*********************************************************************************************************
MOUSE SCROOLING EFFECTS JAVASCRIPT FOR SECOND HEADER GOES HERE
*********************************************************************/
// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Get the topbar element
    const topbar = document.querySelector('#second-header .topbar');
    
    // Add wheel event listener to the topbar
    topbar.addEventListener('wheel', function(event) {
        // Prevent the default vertical scroll
        event.preventDefault();
        
        // Get the scroll amount based on wheel delta
        // Multiply by 2 for faster scrolling or reduce for slower scrolling
        const scrollAmount = event.deltaY * 2;
        
        // Smooth scroll horizontally
        this.scrollBy({
            left: scrollAmount,
            behavior: 'smooth'
        });
    });
    
    // Optional: Add touch scrolling for mobile devices
    let isScrolling = false;
    let startX;
    let scrollLeft;

    topbar.addEventListener('touchstart', (e) => {
        isScrolling = true;
        startX = e.touches[0].pageX - topbar.offsetLeft;
        scrollLeft = topbar.scrollLeft;
    });

    topbar.addEventListener('touchmove', (e) => {
        if (!isScrolling) return;
        
        e.preventDefault();
        const x = e.touches[0].pageX - topbar.offsetLeft;
        const distance = (x - startX);
        topbar.scrollLeft = scrollLeft - distance;
    });

    topbar.addEventListener('touchend', () => {
        isScrolling = false;
    });
    
    // Add keyboard navigation support
    topbar.tabIndex = 0; // Make the topbar focusable
    topbar.addEventListener('keydown', (e) => {
        switch(e.key) {
            case 'ArrowLeft':
                e.preventDefault();
                topbar.scrollBy({
                    left: -100,
                    behavior: 'smooth'
                });
                break;
            case 'ArrowRight':
                e.preventDefault();
                topbar.scrollBy({
                    left: 100,
                    behavior: 'smooth'
                });
                break;
        }
    });
});






/****************************************************************************
TESTIMONY SUBMISSION FORM JAVASCRIPT GOES HERE
*********************************************************************************/
// Testimonial Form Validation
document.addEventListener('DOMContentLoaded', () => {
    // Form elements
    const form = document.getElementById('testimonial-form');
    const nameInput = document.getElementById('name');
    const roleInput = document.getElementById('role');
    const imageInput = document.getElementById('image');
    const testimonialContent = document.getElementById('testimonial-content');
    const ratingSelect = document.getElementById('rating');
    const submitButton = document.querySelector('.submit-btn');

    // Create error message container
    const errorContainer = document.createElement('div');
    errorContainer.classList.add('error-container');
    if (form) {
        form.insertBefore(errorContainer, form.firstChild);
    }

    // Function to validate file type and size
    const validateFile = (file) => {
        const allowedTypes = ['image/png', 'image/jpeg', 'image/jpg', 'image/svg+xml'];
        const maxSize = 5 * 1024 * 1024; // 5MB

        if (!allowedTypes.includes(file.type)) {
            return {
                valid: false,
                message: 'Only PNG, JPEG, JPG, or SVG files are allowed'
            };
        }

        if (file.size > maxSize) {
            return {
                valid: false,
                message: 'File size must be less than 5MB'
            };
        }

        return { valid: true };
    };

    // Function to show image preview
    const showImagePreview = (file) => {
        const preview = document.getElementById('image-preview') || document.createElement('div');
        preview.id = 'image-preview';
        preview.className = 'image-preview';

        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                preview.innerHTML = `
                    <img src="${e.target.result}" alt="Preview" style="max-width: 200px; max-height: 200px;">
                    <button type="button" class="remove-image">×</button>
                `;
                
                // Add remove button functionality
                preview.querySelector('.remove-image').onclick = () => {
                    imageInput.value = '';
                    preview.innerHTML = '';
                    validateForm();
                };
            };
            reader.readAsDataURL(file);
        } else {
            preview.innerHTML = '';
        }

        if (!preview.parentNode && imageInput.parentNode) {
            imageInput.parentNode.appendChild(preview);
        }
    };

    // Function to show error message
    const showError = (message) => {
        errorContainer.innerHTML = `<div class="error-message">${message}</div>`;
        errorContainer.style.display = 'block';
    };

    // Function to clear error message
    const clearError = () => {
        errorContainer.innerHTML = '';
        errorContainer.style.display = 'none';
    };

    // Form validation function
    const validateForm = () => {
        clearError();
        let isValid = true;
        let errorMessage = '';

        // Name validation
        if (!nameInput.value.trim()) {
            errorMessage = 'Name is required';
            nameInput.classList.add('invalid');
            isValid = false;
        } else {
            nameInput.classList.remove('invalid');
        }

        // Role validation
        if (!roleInput.value.trim()) {
            errorMessage = errorMessage || 'Role is required';
            roleInput.classList.add('invalid');
            isValid = false;
        } else {
            roleInput.classList.remove('invalid');
        }

        // Testimonial content validation
        if (!testimonialContent.value.trim()) {
            errorMessage = errorMessage || 'Testimony content is required';
            testimonialContent.classList.add('invalid');
            isValid = false;
        } else {
            testimonialContent.classList.remove('invalid');
        }

        // Image validation
        if (imageInput && imageInput.files.length > 0) {
            const fileValidation = validateFile(imageInput.files[0]);
            if (!fileValidation.valid) {
                errorMessage = errorMessage || fileValidation.message;
                imageInput.classList.add('invalid');
                isValid = false;
            } else {
                imageInput.classList.remove('invalid');
                showImagePreview(imageInput.files[0]);
            }
        } else if (!imageInput.value) {
            errorMessage = errorMessage || 'Image is required';
            imageInput.classList.add('invalid');
            isValid = false;
        }

        // Show error message if any
        if (errorMessage) {
            showError(errorMessage);
        }

        // Enable/disable submit button
        if (submitButton) {
            submitButton.disabled = !isValid;
        }

        return isValid;
    };

    // Handle form submission
    if (form) {
        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            if (validateForm()) {
                submitButton.disabled = true;
                submitButton.textContent = 'Submitting...';

                try {
                    const formData = new FormData(form);
                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: formData
                    });

                    if (response.ok) {
                        // Check if response redirects
                        const responseUrl = response.url;
                        if (responseUrl.includes('success=1')) {
                            window.location.href = responseUrl;
                        } else {
                            form.reset();
                            showImagePreview(null);
                            showError('Testimonial submitted successfully!');
                        }
                    } else {
                        throw new Error('Submission failed');
                    }
                } catch (error) {
                    showError('Error submitting testimonial. Please try again.');
                } finally {
                    submitButton.disabled = false;
                    submitButton.textContent = 'Submit Testimony';
                }
            }
        });
    }

    // Add event listeners for real-time validation
    const inputs = [nameInput, roleInput, testimonialContent, ratingSelect];
    inputs.forEach(input => {
        if (input) {
            input.addEventListener('input', validateForm);
        }
    });

    // Add special handling for image input
    if (imageInput) {
        imageInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                const fileValidation = validateFile(e.target.files[0]);
                if (fileValidation.valid) {
                    showImagePreview(e.target.files[0]);
                } else {
                    showError(fileValidation.message);
                    e.target.value = '';
                }
            }
            validateForm();
        });
    }
});






/*====================================================================================
BOOKING JAVASCRIPT PORTFOLIO PAGE
=============================================================================*/
document.getElementById('bookingForm').addEventListener('submit', function(e) {
    e.preventDefault();
    let isValid = true;
    const fields = ['name', 'email', 'phone', 'service', 'date', 'description'];

    fields.forEach(field => {
        const element = document.getElementById(field);
        const error = document.getElementById(field + 'Error');
        
        if (!element.value) {
            isValid = false;
            error.style.display = 'block';
            element.style.borderColor = 'var(--error-clr)';
        } else {
            error.style.display = 'none';
            element.style.borderColor = 'var(--verylightpurple)';
        }

        if (field === 'email' && !validateEmail(element.value)) {
            isValid = false;
            error.style.display = 'block';
            element.style.borderColor = 'var(--error-clr)';
        }
    });

    if (isValid) {
        alert('Booking submitted successfully! We will contact you soon.');
        this.reset();
    }
});

function validateEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

// Add animation to form fields on focus
const inputs = document.querySelectorAll('input, select, textarea');
inputs.forEach(input => {
    input.addEventListener('focus', function() {
        this.style.transform = 'translateX(5px)';
        setTimeout(() => {
            this.style.transform = 'translateX(0)';
        }, 200);
    });
});







//INDEX PAGE HERO ANIMATIONS JAVASCRIPT

// Animation triggers for scroll effects
document.addEventListener('DOMContentLoaded', () => {
    // Elements that need scroll animations
    const scrollElements = document.querySelectorAll('.scroll-scale');
    
    // Intersection Observer for scroll animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
            }
        });
    }, { threshold: 0.1 });

    // Observe all scroll elements
    scrollElements.forEach(element => {
        observer.observe(element);
    });

    // Custom cursor movement for canvas
    const cursor = document.querySelector('.cursor');
    const canvas = document.querySelector('.canvas');
    
    if (cursor && canvas) {
        // Get canvas boundaries
        const canvasRect = canvas.getBoundingClientRect();
        
        // Smooth cursor movement
        function moveCursor(x, y, duration = 500) {
            cursor.style.transition = `all ${duration}ms ease`;
            cursor.style.left = `${x}%`;
            cursor.style.top = `${y}%`;
        }

        // Cursor animation sequence
        function animateCursor() {
            const positions = [
                { x: 20, y: 20 },
                { x: 80, y: 20 },
                { x: 80, y: 80 },
                { x: 20, y: 80 }
            ];

            let currentPos = 0;

            function nextPosition() {
                moveCursor(positions[currentPos].x, positions[currentPos].y);
                currentPos = (currentPos + 1) % positions.length;
            }

            // Start the sequence
            nextPosition();
            setInterval(nextPosition, 2000);
        }

        animateCursor();
    }

    // Pen tool drawing animation enhancement
    const penTool = document.querySelector('.pen-tool');
    
    if (penTool) {
        let isDrawing = false;
        
        function toggleDrawing() {
            isDrawing = !isDrawing;
            penTool.style.animation = isDrawing ? 'draw 2s infinite' : 'none';
        }

        // Start drawing animation on hover
        penTool.addEventListener('mouseenter', () => {
            if (!isDrawing) toggleDrawing();
        });

        penTool.addEventListener('mouseleave', () => {
            if (isDrawing) toggleDrawing();
        });
    }

    // Color palette interaction
    const colorPalette = document.querySelector('.color-palette');
    const colors = document.querySelectorAll('.color');
    
    if (colorPalette && colors.length) {
        colors.forEach(color => {
            color.addEventListener('mouseenter', () => {
                // Scale up the hovered color
                color.style.transform = 'scale(1.2)';
                color.style.transition = 'transform 0.3s ease';
                
                // Add glow effect
                color.style.boxShadow = '0 0 15px rgba(255,255,255,0.5)';
            });

            color.addEventListener('mouseleave', () => {
                // Reset styles
                color.style.transform = 'scale(1)';
                color.style.boxShadow = '0 3px 6px rgba(0,0,0,0.2)';
            });
        });
    }

    // Business card hover effect
    const businessCard = document.querySelector('.business-card');
    
    if (businessCard) {
        businessCard.addEventListener('mouseenter', () => {
            // 3D rotation effect
            businessCard.style.transform = 'rotate(-15deg) translateZ(20px)';
            businessCard.style.transition = 'transform 0.3s ease';
            businessCard.style.boxShadow = '0 15px 30px rgba(0,0,0,0.2)';
        });

        businessCard.addEventListener('mouseleave', () => {
            businessCard.style.transform = 'rotate(-10deg) translateZ(0)';
            businessCard.style.boxShadow = '0 8px 16px rgba(0,0,0,0.1)';
        });
    }

    // Floating animation randomization
    const floatingElements = document.querySelectorAll('.floating-elements .element');
    
    floatingElements.forEach(element => {
        // Randomize floating animation timing
        const delay = Math.random() * 2;
        const duration = 3 + Math.random() * 2;
        
        element.style.animation = `float ${duration}s infinite ${delay}s`;
    });
});

// Add necessary styles for JavaScript animations
const style = document.createElement('style');
style.textContent = `
    .scroll-scale {
        opacity: 0;
        transform: scale(0.95) translateY(20px);
        transition: all 0.6s ease-out;
    }

    .scroll-scale.active {
        opacity: 1;
        transform: scale(1) translateY(0);
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }

    .color-palette .color {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .business-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        transform-style: preserve-3d;
    }
`;

document.head.appendChild(style);