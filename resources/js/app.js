import './bootstrap';
import './components/pdf-viewer'; 
import { SuccessMessage } from './components/success-message';
import { BookCard } from './components/book-card';

// Inicialización global
document.addEventListener('DOMContentLoaded', function () {
    // Auto-inicializar PDF Viewer si existe en la página
    if (document.getElementById('pdfViewer')) {
        const pdfViewer = new window.PDFViewer();
        pdfViewer.init();

        // Hacer disponible globalmente para los onclick
        window.pdfViewerInstance = pdfViewer;
    }
});

window.SuccessMessage = SuccessMessage;
window.BookCard = BookCard;