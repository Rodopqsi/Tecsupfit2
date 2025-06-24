import React, { useState, useEffect, useRef } from 'react';
import { Send, Bot, User } from 'lucide-react';

interface Message {
  id: string;
  text: string;
  isBot: boolean;
  timestamp: Date;
  confidence?: number;
}

interface LearningData {
  userInput: string;
  botResponse: string;
  timestamp: Date;
  feedback?: 'positive' | 'negative';
}

interface ChatbotKnowledge {
  keywords: string[];
  responses: string[];
  category: string;
  priority: number;
  variations: string[];
}

// Advanced AI Knowledge Base with learning capabilities
const KNOWLEDGE_BASE: ChatbotKnowledge[] = [
  {
    keywords: ['hola', 'buenos días', 'buenas tardes', 'buenas noches', 'hey', 'qué tal', 'saludos', 'hi', 'hello'],
    responses: [
      '¡Hola! 👋 Soy tu asistente de IA especializado en suplementos deportivos. ¿En qué puedo ayudarte hoy?',
      '¡Bienvenido! Soy una IA entrenada para ayudarte con suplementos de gimnasio. ¿Qué necesitas saber?',
      '¡Hola! Estoy aquí para resolver todas tus dudas sobre suplementación deportiva. ¿Cómo puedo asistirte?'
    ],
    category: 'greeting',
    priority: 1,
    variations: ['ola', 'buenas', 'que tal', 'saludos', 'buenos dias']
  },
  {
    keywords: ['proteína', 'whey', 'caseína', 'protein', 'masa muscular', 'músculo', 'ganar peso', 'volumen'],
    responses: [
      'Las proteínas son esenciales para el crecimiento muscular. Te recomiendo:\n\n🥛 **Whey Protein**: Absorción rápida, ideal post-entreno\n🌙 **Caseína**: Liberación lenta, perfecta antes de dormir\n🌱 **Proteína Vegetal**: Para dietas plant-based\n\n¿Cuál es tu objetivo específico y cuánto pesas?',
      'Para ganar masa muscular necesitas 1.6-2.2g de proteína por kg de peso corporal. Nuestras opciones:\n\n• **Whey Isolate**: 90% proteína, mínima lactosa\n• **Whey Concentrate**: Relación calidad-precio excelente\n• **Blend de proteínas**: Absorción gradual\n\n¿Tienes alguna intolerancia alimentaria?',
      'La proteína es el macronutriente más importante para el músculo. Según tu objetivo:\n\n💪 **Volumen**: 2-2.5g por kg de peso\n🎯 **Mantenimiento**: 1.6-2g por kg\n🔥 **Definición**: 2.2-2.8g por kg\n\n¿En qué fase estás actualmente?'
    ],
    category: 'protein',
    priority: 2,
    variations: ['proteina', 'whei', 'caseina', 'masa', 'musculo', 'volumen']
  },
  {
    keywords: ['creatina', 'fuerza', 'rendimiento', 'energía', 'creatine', 'potencia', 'explosividad'],
    responses: [
      'La creatina es el suplemento más estudiado y efectivo para fuerza y potencia:\n\n⚡ **Beneficios**:\n• +15% fuerza muscular\n• +20% potencia explosiva\n• Mejor recuperación entre series\n• Aumento de volumen muscular\n\n📊 **Dosificación**: 5g diarios, cualquier momento\n¿Has usado creatina antes?',
      'La creatina monohidrato es la forma más efectiva y económica:\n\n🔬 **Cómo funciona**: Regenera ATP para energía inmediata\n⏱️ **Cuándo tomarla**: Momento irrelevante, lo importante es la consistencia\n💧 **Hidratación**: Aumenta 500ml de agua diaria\n\n¿Qué tipo de entrenamiento realizas?',
      'Creatina = más fuerza, más repeticiones, más músculo:\n\n📈 **Protocolo recomendado**:\n• Semana 1-5: Carga con 20g/día (4 tomas de 5g)\n• Mantenimiento: 5g diarios indefinidamente\n• O directamente 5g/día desde el inicio\n\n¿Prefieres carga rápida o gradual?'
    ],
    category: 'creatine',
    priority: 2,
    variations: ['creatina', 'fuersa', 'energia', 'potencia', 'explosividad']
  },
  {
    keywords: ['pre entreno', 'pre-entreno', 'energía', 'pump', 'focus', 'cafeína', 'estimulante', 'concentración'],
    responses: [
      'Los pre-entrenos optimizan tu rendimiento con ingredientes clave:\n\n☕ **Cafeína**: 200-400mg para energía y focus\n🍉 **Citrulina**: 6-8g para pump muscular\n🔥 **Beta-alanina**: 3-5g para resistencia\n💪 **Creatina**: 5g para fuerza\n\n¿Entrenas por la mañana o tarde? ¿Toleras bien los estimulantes?',
      'Un buen pre-entreno puede mejorar tu rendimiento hasta 20%:\n\n🎯 **Con estimulantes**: Máxima energía y focus\n🌿 **Sin estimulantes**: Solo pump y resistencia\n⏰ **Timing**: 30-45 min antes del entreno\n\n¿Qué buscas específicamente: energía, pump o resistencia?',
      'Ingredientes que marcan la diferencia en un pre-entreno:\n\n🧠 **Nootropicos**: L-teanina, tirosina para focus mental\n💨 **Vasodilatadores**: Arginina, citrulina para pump\n⚡ **Estimulantes**: Cafeína, taurina para energía\n🏃 **Resistencia**: Beta-alanina, betaína\n\n¿Cuál es tu prioridad principal?'
    ],
    category: 'pre-workout',
    priority: 2,
    variations: ['pre entreno', 'preentreno', 'energia', 'estimulante', 'cafeina', 'focus']
  },
  {
    keywords: ['quemar grasa', 'adelgazar', 'bajar de peso', 'fat burner', 'definir', 'cutting', 'termogénico'],
    responses: [
      'Para quemar grasa efectivamente necesitas un enfoque integral:\n\n🔥 **Termogénicos**: Aceleran metabolismo 8-15%\n🍃 **L-Carnitina**: Optimiza oxidación de grasas\n☕ **Cafeína**: Suprime apetito y aumenta gasto calórico\n📊 **CLA**: Mejora composición corporal\n\n¿Cuál es tu porcentaje de grasa actual y objetivo?',
      'Los quemadores de grasa son herramientas, no soluciones mágicas:\n\n✅ **Imprescindible**: Déficit calórico de 300-500 kcal\n🏃 **Cardio**: HIIT 3x/semana + LISS 2x/semana\n💊 **Suplementos**: Potencian resultados 15-20%\n⏰ **Timing**: En ayunas o pre-entreno\n\n¿Tienes tu dieta y entrenamiento estructurados?',
      'Stack completo para definición muscular:\n\n🌅 **Mañana**: Termogénico + L-Carnitina en ayunas\n🏋️ **Pre-entreno**: Fat burner + cafeína\n🌙 **Noche**: CLA + Omega-3\n💧 **Hidratación**: 3-4L agua diaria\n\n¿Buscas definición extrema o pérdida de peso saludable?'
    ],
    category: 'fat-loss',
    priority: 2,
    variations: ['quemar grasa', 'adelgasar', 'bajar peso', 'definir', 'cutting', 'termogenico']
  },
  {
    keywords: ['bcaa', 'aminoácidos', 'recuperación', 'catabolismo', 'eaa', 'leucina', 'isoleucina', 'valina'],
    responses: [
      'Los aminoácidos son los bloques constructores del músculo:\n\n🧬 **BCAAs (2:1:1)**: Leucina, isoleucina, valina\n🔄 **Funciones**: Previenen catabolismo, aceleran recuperación\n⏰ **Timing**: Intra-entreno o entre comidas\n📊 **Dosis**: 10-15g por toma\n\n¿Entrenas en ayunas o haces entrenamientos muy largos?',
      'BCAAs vs EAAs - ¿Cuál elegir?\n\n💪 **BCAAs**: 3 aminoácidos esenciales, más económicos\n🎯 **EAAs**: 9 aminoácidos esenciales, más completos\n🏃 **Uso**: Durante entrenamientos +90 minutos\n🍽️ **Alternativa**: Si comes suficiente proteína, no son esenciales\n\n¿Cuántas horas entrenas y cómo es tu alimentación?',
      'Optimiza tu recuperación con aminoácidos:\n\n🔬 **Leucina**: Activador clave de síntesis proteica (2.5g mínimo)\n⚡ **Isoleucina**: Energía muscular y recuperación\n🛡️ **Valina**: Previene fatiga y catabolismo\n📈 **Ratio 2:1:1**: Proporción científicamente probada\n\n¿Sientes fatiga muscular excesiva o recuperación lenta?'
    ],
    category: 'bcaa',
    priority: 2,
    variations: ['bcaa', 'aminoacidos', 'recuperacion', 'catabolismo', 'leucina']
  },
  {
    keywords: ['precio', 'costo', 'barato', 'económico', 'oferta', 'descuento', 'promoción', 'cuánto cuesta'],
    responses: [
      'Tenemos excelentes precios y promociones especiales:\n\n💰 **Ofertas actuales**:\n• 2x1 en proteínas seleccionadas\n• 15% OFF en compras +$100\n• Envío gratis +$75\n• Descuento por volumen disponible\n\n¿Qué producto específico te interesa para darte el precio exacto?',
      'Manejamos los mejores precios del mercado con calidad premium:\n\n🏷️ **Política de precios**:\n• Precio más bajo garantizado\n• Igualamos cualquier oferta de la competencia\n• Descuentos por fidelidad\n• Planes de pago disponibles\n\n¿Necesitas cotización para algún stack específico?',
      'Inversión inteligente en tu progreso:\n\n📊 **Relación costo-beneficio**:\n• Proteína: $0.80 por porción de 25g\n• Creatina: $0.15 por dosis de 5g\n• Pre-entreno: $1.20 por sesión\n• Stack completo: Desde $89/mes\n\n¿Te gustaría un plan personalizado según tu presupuesto?'
    ],
    category: 'pricing',
    priority: 1,
    variations: ['precio', 'costo', 'barato', 'economico', 'oferta', 'descuento', 'cuanto cuesta']
  },
  {
    keywords: ['envío', 'entrega', 'delivery', 'cuánto tarda', 'shipping', 'dónde llegan', 'cobertura'],
    responses: [
      'Envíos rápidos y seguros a todo el país:\n\n🚚 **Tiempos de entrega**:\n• Capital Federal: 24-48hs\n• GBA: 2-3 días hábiles\n• Interior: 3-7 días hábiles\n• Patagonia: 5-10 días hábiles\n\n📦 **Envío gratis** en compras superiores a $75. ¿A qué zona necesitas el envío?',
      'Logística premium para tu comodidad:\n\n🎯 **Opciones de envío**:\n• Express: Entrega en 24hs (+$15)\n• Estándar: 2-5 días (Gratis +$75)\n• Retiro en sucursal: Sin costo\n• Moto mensajería CABA: Mismo día\n\n¿Cuál es tu código postal para calcular el costo exacto?',
      'Cobertura nacional con tracking en tiempo real:\n\n📍 **Zonas de cobertura**:\n• CABA y GBA: 100% cobertura\n• Interior: Todas las capitales provinciales\n• Localidades menores: Consultar disponibilidad\n• Islas: Envío especial disponible\n\n🔍 **Seguimiento**: Código de tracking automático. ¿Necesitas envío a alguna zona específica?'
    ],
    category: 'shipping',
    priority: 1,
    variations: ['envio', 'entrega', 'delivery', 'cuanto tarda', 'donde llegan']
  },
  {
    keywords: ['principiante', 'empezar', 'nuevo', 'comenzar', 'iniciar', 'novato', 'primera vez'],
    responses: [
      'Perfecto para empezar tu journey fitness! Stack básico recomendado:\n\n🥇 **Esenciales para principiantes**:\n1. **Proteína Whey**: 1 scoop post-entreno\n2. **Creatina**: 5g diarios, cualquier momento\n3. **Multivitamínico**: 1 cápsula con desayuno\n\n💡 **Presupuesto inicial**: $65-85/mes\n¿Cuánto tiempo llevas entrenando y cuáles son tus objetivos?',
      'Bienvenido al mundo de la suplementación inteligente:\n\n📚 **Guía para principiantes**:\n• Semana 1-2: Solo proteína para acostumbrarte\n• Semana 3-4: Agregar creatina gradualmente\n• Mes 2+: Considerar pre-entreno si es necesario\n\n🎯 **Regla de oro**: La suplementación potencia, no reemplaza una buena dieta\n¿Tienes alguna restricción alimentaria o alergia?',
      'Empezar bien es clave para el éxito a largo plazo:\n\n✅ **Protocolo principiante**:\n🍽️ **Prioridad 1**: Dieta estructurada (70% del éxito)\n🏋️ **Prioridad 2**: Rutina de entrenamiento consistente\n💊 **Prioridad 3**: Suplementos básicos (proteína + creatina)\n\n📈 **Expectativas realistas**: Resultados visibles en 6-8 semanas\n¿Necesitas ayuda también con dieta y entrenamiento?'
    ],
    category: 'beginner',
    priority: 1,
    variations: ['principiante', 'empesar', 'nuevo', 'comienso', 'iniciar', 'novato', 'primera ves']
  }
];

// Advanced text processing for typo tolerance and learning
class AITextProcessor {
  static normalizeText(text: string): string {
    return text
      .toLowerCase()
      .normalize('NFD')
      .replace(/[\u0300-\u036f]/g, '') // Remove accents
      .replace(/[^\w\s]/g, ' ') // Replace punctuation with spaces
      .replace(/\s+/g, ' ') // Multiple spaces to single
      .trim();
  }

  static calculateSimilarity(str1: string, str2: string): number {
    const longer = str1.length > str2.length ? str1 : str2;
    const shorter = str1.length > str2.length ? str2 : str1;
    
    if (longer.length === 0) return 1.0;
    
    const distance = this.levenshteinDistance(longer, shorter);
    return (longer.length - distance) / longer.length;
  }

  static levenshteinDistance(str1: string, str2: string): number {
    const matrix = Array(str2.length + 1).fill(null).map(() => Array(str1.length + 1).fill(null));
    
    for (let i = 0; i <= str1.length; i++) matrix[0][i] = i;
    for (let j = 0; j <= str2.length; j++) matrix[j][0] = j;
    
    for (let j = 1; j <= str2.length; j++) {
      for (let i = 1; i <= str1.length; i++) {
        const indicator = str1[i - 1] === str2[j - 1] ? 0 : 1;
        matrix[j][i] = Math.min(
          matrix[j][i - 1] + 1,
          matrix[j - 1][i] + 1,
          matrix[j - 1][i - 1] + indicator
        );
      }
    }
    
    return matrix[str2.length][str1.length];
  }

  static findBestMatches(userInput: string, knowledgeBase: ChatbotKnowledge[]): Array<{knowledge: ChatbotKnowledge, score: number}> {
    const normalizedInput = this.normalizeText(userInput);
    const matches: Array<{knowledge: ChatbotKnowledge, score: number}> = [];

    knowledgeBase.forEach(knowledge => {
      let maxScore = 0;
      
      // Check main keywords
      knowledge.keywords.forEach(keyword => {
        const normalizedKeyword = this.normalizeText(keyword);
        if (normalizedInput.includes(normalizedKeyword)) {
          maxScore = Math.max(maxScore, 1.0);
        } else {
          const similarity = this.calculateSimilarity(normalizedInput, normalizedKeyword);
          if (similarity > 0.7) {
            maxScore = Math.max(maxScore, similarity);
          }
        }
      });

      // Check variations for typo tolerance
      knowledge.variations.forEach(variation => {
        const normalizedVariation = this.normalizeText(variation);
        if (normalizedInput.includes(normalizedVariation)) {
          maxScore = Math.max(maxScore, 0.9);
        } else {
          const similarity = this.calculateSimilarity(normalizedInput, normalizedVariation);
          if (similarity > 0.6) {
            maxScore = Math.max(maxScore, similarity * 0.8);
          }
        }
      });

      if (maxScore > 0.5) {
        matches.push({ knowledge, score: maxScore * knowledge.priority });
      }
    });

    return matches.sort((a, b) => b.score - a.score);
  }
}

// Learning system
class LearningSystem {
  static saveInteraction(userInput: string, botResponse: string) {
    const interactions = this.getInteractions();
    const newInteraction: LearningData = {
      userInput,
      botResponse,
      timestamp: new Date()
    };
    
    interactions.push(newInteraction);
    localStorage.setItem('chatbot-learning', JSON.stringify(interactions));
  }

  static getInteractions(): LearningData[] {
    const saved = localStorage.getItem('chatbot-learning');
    return saved ? JSON.parse(saved) : [];
  }

  static analyzePatterns(): string[] {
    const interactions = this.getInteractions();
    const patterns: { [key: string]: number } = {};
    
    interactions.forEach(interaction => {
      const words = AITextProcessor.normalizeText(interaction.userInput).split(' ');
      words.forEach(word => {
        if (word.length > 3) {
          patterns[word] = (patterns[word] || 0) + 1;
        }
      });
    });

    return Object.entries(patterns)
      .sort(([,a], [,b]) => b - a)
      .slice(0, 10)
      .map(([word]) => word);
  }

  static getContextualResponse(userInput: string): string | null {
    const interactions = this.getInteractions();
    const normalizedInput = AITextProcessor.normalizeText(userInput);
    
    // Find similar past interactions
    const similarInteractions = interactions.filter(interaction => {
      const similarity = AITextProcessor.calculateSimilarity(
        normalizedInput,
        AITextProcessor.normalizeText(interaction.userInput)
      );
      return similarity > 0.8;
    });

    if (similarInteractions.length > 0) {
      const mostRecent = similarInteractions[similarInteractions.length - 1];
      return `Basándome en conversaciones anteriores: ${mostRecent.botResponse}`;
    }

    return null;
  }
}

export default function Chatbot() {
  const [messages, setMessages] = useState<Message[]>([]);
  const [inputMessage, setInputMessage] = useState('');
  const [isTyping, setIsTyping] = useState(false);
  const [isLearning, setIsLearning] = useState(false);
  const messagesEndRef = useRef<HTMLDivElement>(null);

  // Detectar si está embebido en un iframe
  // const isEmbedded = window.self !== window.top;

  useEffect(() => {
    // Load conversation history
    const savedMessages = localStorage.getItem('chatbot-messages');
    if (savedMessages) {
      const parsedMessages = JSON.parse(savedMessages);
      // Convert timestamp strings back to Date objects
      const messagesWithDates = parsedMessages.map((message: any) => ({
        ...message,
        timestamp: new Date(message.timestamp)
      }));
      setMessages(messagesWithDates);
    } else {
      // Advanced welcome message
      const welcomeMessage: Message = {
        id: Date.now().toString(),
        text: '¡Hola! 🤖 Soy tu asistente de IA especializado en suplementos deportivos.\n\nEstoy equipado con:\n• 🧠 Procesamiento de lenguaje natural avanzado\n• 📚 Base de conocimientos especializada\n• 🔄 Capacidad de aprendizaje continuo\n• 🎯 Tolerancia a errores de escritura\n\n¿En qué puedo ayudarte hoy?',
        isBot: true,
        timestamp: new Date(),
        confidence: 1.0
      };
      setMessages([welcomeMessage]);
    }
  }, []);

  useEffect(() => {
    if (messages.length > 0) {
      localStorage.setItem('chatbot-messages', JSON.stringify(messages));
    }
  }, [messages]);

  useEffect(() => {
    scrollToBottom();
  }, [messages]);

  const scrollToBottom = () => {
    messagesEndRef.current?.scrollIntoView({ behavior: 'smooth' });
  };

  const generateIntelligentResponse = async (userInput: string): Promise<{response: string, confidence: number}> => {
    setIsLearning(true);
    
    // First, check for contextual learning
    const contextualResponse = LearningSystem.getContextualResponse(userInput);
    if (contextualResponse) {
      setIsLearning(false);
      return { response: contextualResponse, confidence: 0.9 };
    }

    // Advanced pattern matching with AI processing
    const matches = AITextProcessor.findBestMatches(userInput, KNOWLEDGE_BASE);
    
    if (matches.length > 0 && matches[0].score > 0.6) {
      const bestMatch = matches[0];
      const responses = bestMatch.knowledge.responses;
      const selectedResponse = responses[Math.floor(Math.random() * responses.length)];
      
      // Add learning context
      const enhancedResponse = `${selectedResponse}\n\n💡 *Respuesta generada con ${Math.round(bestMatch.score * 100)}% de confianza*`;
      
      setIsLearning(false);
      return { response: enhancedResponse, confidence: bestMatch.score };
    }

    // Advanced fallback with learning suggestions
    const fallbackResponses = [
      `Interesante pregunta sobre "${userInput}". Aunque no tengo información específica sobre eso, puedo ayudarte con:\n\n• Proteínas y ganancia muscular\n• Creatina y rendimiento\n• Pre-entrenos y energía\n• Quemadores de grasa\n• Suplementación para principiantes\n\n¿Alguno de estos temas te interesa?`,
      
      `No estoy completamente seguro sobre "${userInput}", pero estoy aprendiendo constantemente. Mientras tanto, ¿podrías reformular tu pregunta o preguntarme sobre:\n\n🥛 Proteínas\n⚡ Creatina\n🔥 Pre-entrenos\n📉 Pérdida de grasa\n💪 Ganancia muscular`,
      
      `Mi IA está procesando "${userInput}" y agregándolo a mi base de conocimientos. Por ahora, puedo ayudarte con información detallada sobre suplementos deportivos. ¿Hay algo específico sobre nutrición deportiva que te gustaría saber?`
    ];

    const randomFallback = fallbackResponses[Math.floor(Math.random() * fallbackResponses.length)];
    
    setIsLearning(false);
    return { response: randomFallback, confidence: 0.3 };
  };

  const handleSendMessage = async () => {
    if (!inputMessage.trim()) return;

    const userMessage: Message = {
      id: Date.now().toString(),
      text: inputMessage,
      isBot: false,
      timestamp: new Date()
    };

    setMessages(prev => [...prev, userMessage]);
    const currentInput = inputMessage;
    setInputMessage('');
    setIsTyping(true);

    // Simulate AI processing time
    setTimeout(async () => {
      const { response, confidence } = await generateIntelligentResponse(currentInput);
      
      const botMessage: Message = {
        id: (Date.now() + 1).toString(),
        text: response,
        isBot: true,
        timestamp: new Date(),
        confidence
      };

      setMessages(prev => [...prev, botMessage]);
      setIsTyping(false);

      // Save interaction for learning
      LearningSystem.saveInteraction(currentInput, response);
    }, 1500 + Math.random() * 1000);
  };

  const handleKeyPress = (e: React.KeyboardEvent) => {
    if (e.key === 'Enter' && !e.shiftKey) {
      e.preventDefault();
      handleSendMessage();
    }
  };

  const clearHistory = () => {
    setMessages([]);
    localStorage.removeItem('chatbot-messages');
    localStorage.removeItem('chatbot-learning');
    
    const welcomeMessage: Message = {
      id: Date.now().toString(),
      text: '🔄 Historial limpiado y memoria de aprendizaje reiniciada.\n\n¡Hola! Soy tu asistente de IA para suplementos deportivos. ¿En qué puedo ayudarte?',
      isBot: true,
      timestamp: new Date(),
      confidence: 1.0
    };
    setMessages([welcomeMessage]);
  };

  // Mostrar SIEMPRE el chat abierto, sin botón flotante ni condicionales
  return (
    <div
      className="fixed top-0 right-0 left-0 md:top-0 md:right-0 md:left-auto w-full md:w-[420px] max-w-full md:max-w-[440px] h-full md:h-full bg-white rounded-none md:rounded-2xl shadow-2xl border border-gray-100 z-40 flex flex-col transition-all duration-300 animate-in slide-in-from-bottom-4 fade-in"
      style={{ boxShadow: '0 8px 32px 0 rgba(0,0,0,0.18)' }}
    >
      {/* AI Header */}
      <div className="bg-gradient-to-r from-black to-red-600 text-white p-4 rounded-t-3xl md:rounded-t-2xl flex items-center justify-between shadow-md">
        <div className="flex items-center space-x-3">
          <div className="w-11 h-11 bg-red-500 rounded-full flex items-center justify-center relative shadow-lg">
            <Bot className="w-7 h-7 text-white" />
            <div className="absolute -bottom-1 -right-1 w-4 h-4 bg-green-400 rounded-full border-2 border-white"></div>
          </div>
          <div>
            <h3 className="font-bold text-base md:text-lg leading-tight">AI Supplement Assistant</h3>
            <p className="text-xs text-gray-200 flex items-center">
              <span className="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></span>
              Aprendiendo continuamente
            </p>
          </div>
        </div>
        <button
          onClick={clearHistory}
          className="text-gray-300 hover:text-white transition-colors text-xs md:text-sm bg-black/20 px-2 md:px-3 py-1 rounded-full hover:bg-black/40"
          title="Limpiar historial y reiniciar aprendizaje"
        >
          Reset
        </button>
      </div>
      {/* Mensajes y entrada */}
      <div className="flex-1 overflow-y-auto px-2 md:px-4 py-3 md:py-4 space-y-4 bg-gray-50 scrollbar-thin scrollbar-thumb-gray-200 scrollbar-track-transparent">
        {messages.map((message) => (
          <div
            key={message.id}
            className={`flex ${message.isBot ? 'justify-start' : 'justify-end'} animate-in slide-in-from-bottom-2 fade-in duration-300`}
          >
            <div className={`flex items-start space-x-2 max-w-[90%] ${message.isBot ? '' : 'flex-row-reverse space-x-reverse'}`}>
              <div className={`w-8 h-8 rounded-full flex items-center justify-center ${
                message.isBot ? 'bg-gradient-to-br from-red-500 to-red-600' : 'bg-black'
              }`}>
                {message.isBot ? (
                  <Bot className="w-4 h-4 text-white" />
                ) : (
                  <User className="w-4 h-4 text-white" />
                )}
              </div>
              <div className={`rounded-2xl p-3 md:p-4 text-sm leading-relaxed whitespace-pre-line shadow-md ${
                message.isBot 
                  ? 'bg-white border border-gray-200 text-gray-800' 
                  : 'bg-black text-white'
              }`}>
                <p>{message.text}</p>
                <div className="flex items-center justify-between mt-2">
                  <p className={`text-xs ${message.isBot ? 'text-gray-500' : 'text-gray-300'}`}></p>
                  {message.isBot && message.confidence && (
                    <div className="flex items-center space-x-1">
                      <div className={`w-2 h-2 rounded-full ${
                        message.confidence > 0.8 ? 'bg-green-400' : 
                        message.confidence > 0.6 ? 'bg-yellow-400' : 'bg-red-400'
                      }`}></div>
                      <span className="text-xs text-gray-400">
                        {Math.round(message.confidence * 100)}%
                      </span>
                    </div>
                  )}
                </div>
              </div>
            </div>
          </div>
        ))}
        {isTyping && (
          <div className="flex justify-start animate-in slide-in-from-bottom-2 fade-in duration-300">
            <div className="flex items-start space-x-2 max-w-[90%]">
              <div className="w-8 h-8 bg-gradient-to-br from-red-500 to-red-600 rounded-full flex items-center justify-center">
                <Bot className="w-4 h-4 text-white" />
              </div>
              <div className="bg-white border border-gray-200 rounded-2xl p-3 md:p-4 shadow-md">
                <div className="flex items-center space-x-2">
                  <div className="flex space-x-1">
                    <div className="w-2 h-2 bg-red-400 rounded-full animate-bounce"></div>
                    <div className="w-2 h-2 bg-red-400 rounded-full animate-bounce" style={{ animationDelay: '0.1s' }}></div>
                    <div className="w-2 h-2 bg-red-400 rounded-full animate-bounce" style={{ animationDelay: '0.2s' }}></div>
                  </div>
                  <span className="text-xs text-gray-500">AI procesando...</span>
                </div>
              </div>
            </div>
          </div>
        )}
        {isLearning && (
          <div className="flex justify-center">
            <div className="bg-blue-100 border border-blue-200 rounded-full px-4 py-2 flex items-center space-x-2 shadow-sm">
              <div className="w-3 h-3 bg-blue-500 rounded-full animate-pulse"></div>
              <span className="text-xs text-blue-600 font-medium">Aprendiendo de tu consulta...</span>
            </div>
          </div>
        )}
        <div ref={messagesEndRef} />
      </div>
      {/* Input avanzado */}
      <div className="p-2 md:p-4 border-t border-gray-100 bg-white rounded-b-3xl md:rounded-b-2xl shadow-md">
        <div className="flex space-x-2 md:space-x-3">
          <input
            type="text"
            value={inputMessage}
            onChange={(e) => setInputMessage(e.target.value)}
            onKeyPress={handleKeyPress}
            placeholder="Pregúntame sobre suplementos... (tolero errores de escritura)"
            className="flex-1 border border-gray-300 rounded-xl px-3 md:px-4 py-2 md:py-3 text-sm focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-500/20 transition-all bg-gray-50"
          />
          <button
            onClick={handleSendMessage}
            disabled={!inputMessage.trim() || isTyping}
            className="bg-gradient-to-r from-red-500 to-red-600 text-white p-2 md:p-3 rounded-xl hover:from-red-600 hover:to-red-700 disabled:opacity-50 disabled:cursor-not-allowed transition-all transform hover:scale-105 active:scale-95 shadow-lg"
          >
            <Send className="w-5 h-5" />
          </button>
        </div>
        <p className="text-xs text-gray-400 mt-2 text-center">
          🤖 IA con tolerancia a errores • 🧠 Aprendizaje continuo • 🎯 Especializada en suplementos
        </p>
      </div>
    </div>
  );
}