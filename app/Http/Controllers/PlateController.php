<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PlateController extends Controller
{
    //
    public function detectaMatricula() // aquest funciona molt be!!!
    {
        $matricula = "";
        // URL del servidor ESP32-CAM per obtenir la imatge
        $esp32CamUrl = 'http://172.20.10.3/take_photo'; // Ajustar la IP 

        // Fa la petició HTTP per obtenir la imatge
        $response = Http::get($esp32CamUrl);

        // Comprova si la petició va ser exitosa
        if ($response->successful()) {
            // Guardar la imatge a la carpeta pública de Laravel (public/imatges)                
            $imagePath = 'imatges/esp32_image.jpg';
            Storage::disk('public')->put($imagePath, $response->body());
            // Generar la URL pública per accedir a la imatge
            $imageUrl = asset('storage/' . $imagePath);

            // Passar la imatge al servei OCR per extreure el text
            // $matricula = $this->extraureMatriculaOCR($response->body());
          
            // Passar la URL de la imatge i la matrícula a la vista
            return view('matricula.detecta', compact('imageUrl', 'matricula'));
            // Matrícula no detectada
            // return response()->json(['matricula' => $matricula], 200);
        } else {
            $error = $response->json('ErrorMessage') ?? 'Error desconegut a l\'API OCR';               
            return response()->json(['error' => 'No s\'ha pogut obtenir la imatge.'], 500);
        }
    }

    private function extraureMatriculaOCR($imageContent)
    {
        // URL de l'API OCR.space
        $ocrUrl = 'https://api.ocr.space/parse/image';
        
        // Fitxer d'imatge en format binari (el contingut de la resposta HTTP)
        $response = Http::attach('image', $imageContent, 'image.jpg')
            ->post($ocrUrl, [
                'apikey' => env('FREE_OCR_API_KEY'),  // La teva clau de l'API, emmagatzemada a .env
                'language' => 'eng'  // Canvia el codi de llengua si és necessari
            ]);

        // Comprovem si la resposta és correcta
        if ($response->successful()) {
            // Extraiem el text detectat de la resposta
            $data = $response->json();

            // Si hi ha algun resultat, retornem el text de la matrícula
            if (isset($data['ParsedResults'][0]['ParsedText'])) {
                $text = $data['ParsedResults'][0]['ParsedText'];

                $matricula = $this->extraureMatricula($text);
                return $matricula  ?? 'Matrícula no detectada';  // Retornem la matrícula detectada o un missatge per defecte
            }
        }

        return 'Error en la detecció del text';
    }

    private function extraureMatricula($text)
    {
        // Eliminar caràcters \r i \n i altres espais en blanc
        $text = str_replace(["\r", "\n"], '', $text);  // Elimina retorn de carro i salt de línia
        $text = trim($text);  // Elimina espais en blanc a les vores

        // Expressió regular per detectar matrícules (modifica la regex segons el teu país)
        $pattern = '/[A-Z0-9]{1,3}[-\s]?[A-Z0-9]{1,4}[-\s]?[A-Z0-9]{1,4}/i'; // Regex bàsica per a matrícules

        // Buscar coincidències a partir del text netejat
        preg_match($pattern, $text, $matches);

        // Si hi ha coincidències, retorna la primera
        return $matches[0] ?? null;
    }
}